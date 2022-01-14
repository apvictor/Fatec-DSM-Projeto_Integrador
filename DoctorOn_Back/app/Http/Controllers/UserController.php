<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    /**
     * Mostra lista de usuários
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $users = Auth::user();

        if ($users->types_id == 2) {
            $users = User::where('units_id', $users->units_id)->paginate();
        } else {
            $users = User::paginate();
        }

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Mostra formulário de cadastro
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.users.create', ['types' => $types]);
    }

    /**
     * Cadastrar usuário
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'types_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $dados = $request->all();

        if ($dados['types_id'] == 2) {
            $dados['units_id'] = Auth::user()->units_id;
        }

        $dados['password'] = Hash::make($request['password']);

        $this->repository->create($dados);

        return redirect()->route('users.index')->with('toast_success', 'Usuário criado');
    }

    /**
     * Mostra formulário de edição
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $user = $user->join('types', 'users.types_id', '=', 'types.id')
            ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.types_id', 'types.type')
            ->where('users.id', $id)
            ->first();

        $types = Type::all();

        return view('admin.users.edit', ['user' => $user, 'types' => $types]);
    }

    /**
     * Atualizar usuário
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator  = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'types_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        $user->update($data);

        return redirect()->route('users.index')->with('toast_success', 'Usuário atualizado');
    }

    /**
     * Deletar usuário
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index')->with('toast_success', 'Usuário deletado');
    }
}

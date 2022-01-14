<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    protected $repository;

    public function __construct(Type $type)
    {
        $this->repository = $type;
    }

    /**
     * Mostra lista de tipos
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $types = $this->repository->paginate();

        return view('admin.types.index', ['types' => $types]);
    }

    /**
     * Mostra formulário de cadastro
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.types.create', ['types' => $types]);
    }

    /**
     * Cadastrar tipo
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type' => ['required']
            ],
            [
                'type.required' => 'O campo tipo é obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $dados = $request->all();

        $this->repository->create($dados);

        return redirect()->route('types.index')->with('toast_success', 'Tipo criado');
    }

    /**
     * Mostra formulário de edição
     *
     * @param [type] $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        if (!$type = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.types.edit', ['type' => $type]);
    }

    /**
     * Editar tipo
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        if (!$type = $this->repository->find($id)) {
            return redirect()->back()->with('toast_error', 'Erro ao atualizar tipo');
        }

        $data = $request->all();

        $type->update($data);

        return redirect()->route('types.index')->with('toast_success', 'Tipo atualizado');
    }

    /**
     * Deletar tipo
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        if (!$type = $this->repository->find($id)) {
            return redirect()->back()->with('toast_error', 'Erro ao deletar tipo');
        }

        $type->delete();

        return redirect()->route('types.index')->with('toast_success', 'Tipo deletado');
    }
}

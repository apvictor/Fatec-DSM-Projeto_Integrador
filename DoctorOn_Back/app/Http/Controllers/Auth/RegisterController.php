<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Mostrar o formulário de cadastro de Usuários
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Realiza a criação do Usuário no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $dados = $request->only(['name', 'email', 'password']);
        $dados['password'] = Hash::make($dados['password']);
        $dados['types_id'] = 2;
        $dados['uuid'] = Str::uuid();

        User::create($dados);

        return redirect()->route('login.form')->with('toast_success', 'Usuário criado');
    }
}

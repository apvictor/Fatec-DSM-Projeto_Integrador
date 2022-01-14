<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{

    /**
     * Cadastrar endereço
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'cep' => ['required'],
            'street' => ['required'],
            'district' => ['required'],
            'number' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $dados = $request->all();

        $user = Auth::user();

        $dados['units_id'] = $user->units_id;

        Address::create($dados);

        return redirect()->route('admin.index')->with('toast_success', 'Endereço criado');
    }
}

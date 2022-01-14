<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{

    /**
     * Cadastrar unidade
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'unit' => ['required'],
            'cnpj' => ['required', 'unique:units'],
            'phone' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $dados = $request->all();

        $cnpj =  $dados['cnpj'];

        Unit::create($dados);

        $unit = Unit::select('*')->where('cnpj', $cnpj)->first();

        $user = Auth::user();
        $user['units_id'] = $unit->id;
        $user->save();

        return redirect()->route('admin.index')->with('toast_success', 'Unidade criado');
    }
}

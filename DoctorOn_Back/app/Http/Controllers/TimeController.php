<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TimeController extends Controller
{
    /**
     * Cadastrar horário
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $dados = $request->all();

        $user = Auth::user();

        $dados['units_id'] = $user->units_id;
        $dados['always_available'] = $request->always_available == 'on' ? true : false;

        if ($dados['always_available'] == true) {
            $dados['start_time'] = null;
            $dados['end_time'] = null;
        }

        Time::create($dados);

        return redirect()->route('admin.index')->with('toast_success', 'Horário criado');
    }
}

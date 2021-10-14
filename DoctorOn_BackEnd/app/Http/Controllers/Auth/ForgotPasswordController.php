<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgot()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Link de redefinição de senha enviado em seu e-mail.']);
    }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // SELECT USER and UPDATE PASSWORD USER
        $user = User::where('email', $credentials['email'])
            ->update(['password' => Hash::make($credentials['password'])]);

        if ($user == 0) {
            return response()->json(["msg" => "Usuário fora da base de dados"]);
        }

        return response()->json(["msg" => "A senha foi alterada com sucesso"]);
    }
}

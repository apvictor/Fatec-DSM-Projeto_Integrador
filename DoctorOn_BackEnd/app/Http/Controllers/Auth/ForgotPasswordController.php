<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{

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

    public function forgotReset()
    {
        $password = rand(100000, 999999);

        $credentials = request()->validate(['email' => 'required|email']);

        // SELECT USER and UPDATE PASSWORD USER
        $user = User::where('email', $credentials['email'])->first();

        if ($user == null) {
            return response()->json(["msg" => 'E-mail inexistente na base de dados'], 400);
        }

        $user->update(['password' => Hash::make($password)]);

        Mail::send('emails.mail', ['user' => $user, 'password' => $password], function ($m) use ($user) {
            $m->from('doctoron21@gmail.com', 'DoctorOn');
            $m->to($user->email, $user->name)->subject('Nova Senha de Acesso');
        });

        return response()->json(["msg" => 'Nova senha enviada ao ' . $user->email]);
    }
}

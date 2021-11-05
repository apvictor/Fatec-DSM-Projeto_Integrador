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
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // SELECT USER and UPDATE PASSWORD USER
        $user = User::where('email', $credentials['email'])->first();

        if ($user == null) {
            return response()->json(["msg" => 'E-mail inexistente na base de dados'], 400);
        }

        $user->update(['password' => Hash::make($credentials['password'])]);

        return response()->json(["msg" => 'Senha alterada com sucesso!']);
    }


    // WEB

    public function index()
    {
        return view('forgotPassword');
    }

    public function store()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // SELECT USER and UPDATE PASSWORD USER
        $user = User::where('email', $credentials['email'])->first();

        if ($user == null) {
            return response()->json(["msg" => 'E-mail inexistente na base de dados'], 400);
        }

        $user->update(['password' => Hash::make($credentials['password'])]);

        return view('login');
    }
}

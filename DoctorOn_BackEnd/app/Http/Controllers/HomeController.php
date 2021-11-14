<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Doctor;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $doctor_all = Doctor::select()->where('units_id',  $user->units_id)->get();

        $doctor_all = Doctor::join('specialties', 'doctors.specialties_id', '=', 'specialties.id')
            ->where('units_id',  $user->units_id)
            ->select('doctors.*', 'specialties.specialty')
            ->latest("updated_at")
            ->paginate(3);

        $doctor_count = Doctor::select()->where('units_id',  $user->units_id)->count();
        $doctor_active = Doctor::select()->where('active', 1)->where('units_id',  $user->units_id)->count();
        $users = User::select()->where('units_id',  $user->units_id)->count();

        return view('index', [
            'doctor_count' => $doctor_count,
            'doctor_all' => $doctor_all,
            'doctor_active' => $doctor_active,
            'users' => $users,
        ]);
    }

    public function suporte()
    {
        $user = Auth::user();
        $messages = Message::select('*')->where('user_id', $user->id)->latest('updated_at')->get();

        $answers = Answer::join('messages', 'messages.id', '=', 'answers.msg_id')
            ->where('user_id', $user->id)->latest('updated_at')->select('answers.resp', 'messages.*')->get();

        return view('suporte', compact('messages', 'answers'));
    }

    public function create()
    {
        return view('cadastros');
    }
}

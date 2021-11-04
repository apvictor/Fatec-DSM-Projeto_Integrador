<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function sobre()
    {
        return view('sobre');
    }
    public function contato()
    {
        return view('contato');
    }

    public function create()
    {
        return view('cadastros');
    }
}

<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SpecialtyController extends Controller
{
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }


    public function index()
    {
        $specialty = Specialty::select('*')->get();

        if (!isset($specialty)) {
            return response()->json(['error' => 'Especialista não encontrado na base de dados!'], 200);
        }

        return response()->json(['specialties' => $specialty]);
    }
}

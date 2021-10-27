<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Units;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UnitsController extends Controller
{

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return Units::select('*')->get();
    }

    public function show(Request $request)
    {
        $units = Units::select('*')->where('id', $request->id)->first();
        $doctor = Doctor::join('specialties', 'specialties.id', '=', 'doctors.id')->where('doctors.units_id', $request->id)->get();

        return response()->json([
            'units' => $units,
            'doctor' => $doctor
        ]);
    }
}

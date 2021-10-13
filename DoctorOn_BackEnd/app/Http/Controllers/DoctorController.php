<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;


class DoctorController extends Controller
{
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function searchDoctor(Request $request)
    {
        //Validate data
        $data = $request->only('specialty');
        $validator = Validator::make($data, [
            'specialty' => 'required|string',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if ($request->specialty == 'all_specialties') {
            $doctor = Doctor::join('specialties', 'doctors.specialties_id', '=', 'specialties.id')
                ->join('units', 'doctors.units_id', '=', 'units.id')
                ->where('doctors.active', 1)
                ->select('doctors.*', 'specialties.*', 'units.*')
                ->get();
        } else {
            $doctor = Doctor::join('specialties', 'doctors.specialties_id', '=', 'specialties.id')
                ->join('units', 'doctors.units_id', '=', 'units.id')
                ->where('doctors.active', 1)
                ->where('specialties.specialty_used', '=', $request->specialty)
                ->select('doctors.*', 'specialties.*', 'units.*')
                ->get();
        }


        if (!isset($doctor)) {
            return response()->json(['error' => 'Especialista não encontrado na base de dados!'], 200);
        }

        return response()->json(['doctor' => $doctor]);
    }
}

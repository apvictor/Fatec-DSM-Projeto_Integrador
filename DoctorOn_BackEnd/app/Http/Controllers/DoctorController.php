<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Specialty;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;


class DoctorController extends Controller
{
    private $repository;
    private $specialties;

    public function __construct(Doctor $doctor, Specialty $specialty)
    {
        $this->repository = $doctor;
        $this->specialties = $specialty;

        // $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function searchDoctor(Request $request)
    {

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

    // WEB

    public function index()
    {
        $specialty = $this->specialties->all();

        return view('doctor', ['specialty' => $specialty]);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $data['active'] = 0;
        $data['units_id'] = 1;
        $this->repository->create($data);

        return redirect()->route('doctor.index');
    }
}

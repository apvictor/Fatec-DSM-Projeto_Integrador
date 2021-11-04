<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Specialty;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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

        if ($request->hasFile('img_doctor') && $request->file('img_doctor')->isValid()) {
            $ext = $request->img_doctor->extension();

            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                try {
                    // SUBIR PARA SERVER AWS
                    $name = Str::uuid() . '.' . $ext;

                    $file = $request->file('img_doctor');

                    Storage::disk('s3')->put($name, file_get_contents($file));

                    $url = Storage::disk('s3')->url($name);
                    $data['img_doctor'] = $url;
                } catch (FileNotFoundException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            } else {
                dd('Formato invalido!');
            }
        }
        $data['active'] = 1;
        $data['units_id'] = 1;
        $this->repository->create($data);

        return redirect()->route('doctor.index');
    }
}

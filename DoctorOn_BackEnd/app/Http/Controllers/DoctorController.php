<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Specialty;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }

    public function searchDoctor(Request $request)
    {

        if ($request->specialty == 'todos') {
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
        // Remover a Especialidade Todos
        unset($specialty[5]);

        return view('doctor', ['specialty' => $specialty]);
    }

    public function store(Request $request)
    {
        $specialty = $this->specialties->all();
        // Remover a Especialidade Todos
        unset($specialty[7]);

        $credentials = $request->only(
            'name',
            'crm',
            'specialties_id',
            'sex',
            'img_doctor',
            'start_time',
            'end_time'
        );

        //valid credential
        $validator = Validator::make($credentials, [
            'name' => 'required',
            'crm' => 'required',
            'specialties_id' => 'required',
            'sex' => 'required',
            'img_doctor' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        if ($validator->fails()) {
            return view('doctor', ['specialty' => $specialty])->with('msg', $validator->messages());
        }

        $user = Auth::user();

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
                    return view('doctor', ['specialty' => $specialty])->with('msg', $e->getMessage());
                }
            } else {
                return view('doctor', ['specialty' => $specialty])->with('msg', 'Formato invalido!');
            }
        }
        $data['active'] = 0;
        $data['type'] = 1;
        $data['units_id'] = $user->units_id;
        $this->repository->create($data);

        return redirect()->route('home.index')->with('msg', 'Médico cadastrado com sucesso!');
    }

    public function activeDoctor($id, $active)
    {
        $val = (!$active) ? 1 : 0;

        $user = $this->repository->where('id', $id)->first();
        $user->update(['active' => $val]);

        return redirect()->route('home.index');
    }

    public function list()
    {
        $user = Auth::user();

        $doctor_all = Doctor::join('specialties', 'doctors.specialties_id', '=', 'specialties.id')
            ->where('units_id',  $user->units_id)
            ->select('doctors.*', 'specialties.specialty')
            ->latest("updated_at")
            ->paginate(4);

        return view('list_doctor', ['doctor_all' => $doctor_all]);
    }

    public function destroy($id)
    {
        $doctor = $this->repository->where('id', $id)->first();

        $doctor->delete();

        return redirect()->route('doctor.list.index');
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $credentials = $request->only(
            'name',
            'crm',
            'start_time',
            'end_time',
        );

        //valid credential
        $validator = Validator::make($credentials, [
            'name' => 'required',
            'crm' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('doctor.list.index')->with('msg', $validator->messages());
        }

        $doctor = $this->repository->where('id', $id)->first();

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
                    return redirect()->route('doctor.list.index')->with('msg', $e->getMessage());
                    $data['img_doctor'] = $doctor->img_doctor;
                }
            } else {
                $data['img_doctor'] = $doctor->img_doctor;
                return redirect()->route('doctor.list.index')->with('msg', 'Formato invalido!');
            }
        } else {
            $data['img_doctor'] = $doctor->img_doctor;
        }

        $doctor->update($data);

        return redirect()->route('doctor.list.index')->with('msg', 'Médico alterado com sucesso!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    protected $repository;

    public function __construct(Doctor $doctor)
    {
        $this->repository = $doctor;
    }

    public function index()
    {
        $doctors = $this->repository->paginate();

        for ($i = 0; $i < count($doctors); $i++) {
            $specialties = Specialty::find($doctors[$i]['specialties_id']);
            $doctors[$i]['specialty'] =  $specialties->specialty;
        }

        return view('admin.doctors.index', ['doctors' => $doctors]);
    }

    /**
     * Mostra formulário de 
     *
     * @return void
     */
    public function create()
    {
        $specialties = Specialty::all();

        return view('admin.doctors.create', ['specialties' => $specialties]);
    }

    public function store(Request $request)
    {
        $dados = $request->all();

        $dados['units_id'] = Auth::user()->units_id;
        $dados['active'] = 1;
        $dados['specialties_id'] = intval($request['specialties_id']);

        if ($request->hasFile('doctor_img') && $request->doctor_img->isValid()) {

            $ext = $request->doctor_img->extension();

            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                // SUBIR PARA SERVER AWS
                $folder = 'doctors/';
                $uuid = $dados['crm'];
                $name = $folder . $uuid . '.' . $ext;
                $file = $request->file('doctor_img');
                Storage::disk('s3')->put($name, file_get_contents($file));
                $url = Storage::disk('s3')->url($name);
                $dados['doctor_img'] = $url;
            } else {
                return response()->json(['message' => 'Formato inválido!'], 400);
            }
        }

        $this->repository->create($dados);

        return redirect()->route('doctors.index');
    }

    public function edit($id)
    {
        if (!$doctor = $this->repository->find($id)) {
            return redirect()->back();
        }

        $doctor = $doctor->join('specialties', 'doctors.specialties_id', '=', 'specialties.id')
            ->select(
                'doctors.id',
                'doctors.doctor',
                'doctors.crm',
                'doctors.sex',
                'doctors.doctor_img',
                'doctors.active',
                'specialties.specialty'
            )
            ->first();

        $specialties = Specialty::all();


        return view('admin.doctors.edit', ['doctor' => $doctor, 'specialties' => $specialties]);
    }

    public function update(Request $request, $id)
    {
        if (!$doctor = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();
        $data['units_id'] = Auth::user()->units_id;

        if ($data['specialties_id'] == null) {
            $data['specialties_id'] = $doctor->specialties_id;
        } else {
            $data['specialties_id'] = intval($request['specialties_id']);
        }

        if ($request->hasFile('doctor_img') && $request->doctor_img->isValid()) {

            $ext = $request->doctor_img->extension();

            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                // SUBIR PARA SERVER AWS
                $folder = 'doctors/';
                $name = $folder . $doctor->crm . '.' . $ext;
                $file = $request->file('doctor_img');
                Storage::disk('s3')->put($name, file_get_contents($file));
                $url = Storage::disk('s3')->url($name);
                $data['doctor_img'] = $url;
            } else {
                return response()->json(['message' => 'Formato inválido!'], 400);
            }
        }

        $doctor->update($data);

        return redirect()->route('doctors.index');
    }

    public function destroy($id)
    {
        if (!$doctor = $this->repository->find($id)) {
            return redirect()->back();
        }

        $url_cortada = substr($doctor->doctor_img, 47);

        if (Storage::disk('s3')->exists($url_cortada)) {
            Storage::disk('s3')->delete($url_cortada);
        }

        $doctor->delete();

        return redirect()->route('doctors.index');
    }

    public function activeDoctor($id, $active)
    {
        $val = (!$active) ? 1 : 0;

        $user = $this->repository->where('id', $id)->first();
        $user->update(['active' => $val]);

        return redirect()->route('doctors.index');
    }
}

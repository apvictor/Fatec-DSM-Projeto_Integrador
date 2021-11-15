<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SpecialtyController extends Controller
{
    private $repository;

    public function __construct(Specialty $specialty)
    {
        $this->repository = $specialty;
    }

    public function index()
    {
        $specialty = Specialty::select('*')->limit(6)->get();

        if (!isset($specialty)) {
            return response()->json(['error' => 'Especialista não encontrado na base de dados!'], 200);
        }

        return response()->json(['specialties' => $specialty]);
    }


    // WEB

    public function indexWEB()
    {
        return view('specialty');
    }

    public function store(Request $request)
    {
        $credentials = $request->only(
            'specialty',
            'img',
        );

        //valid credential
        $validator = Validator::make($credentials, [
            'specialty' => 'required',
            'img' => 'required',
        ]);

        if ($validator->fails()) {
            return view('specialty')->with('msg', $validator->messages());
        }

        $data = $request->all();

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $ext = $request->img->extension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                try {
                    // SUBIR PARA SERVER AWS
                    $name = Str::uuid() . '.' . $ext;
                    $file = $request->file('img');
                    Storage::disk('s3')->put($name, file_get_contents($file));
                    $url = Storage::disk('s3')->url($name);
                    $data['img'] = $url;
                } catch (FileNotFoundException $e) {
                    return view('specialty')->with('msg', $e->getMessage());
                }
            } else {
                return view('specialty')->with('msg', 'Formato invalido!');
            }
        }
        $data['specialty_used'] = Str::kebab($data['specialty']);
        $this->repository->create($data);

        return redirect()->route('home.index');
    }
}

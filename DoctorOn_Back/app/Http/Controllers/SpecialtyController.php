<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SpecialtyController extends Controller
{
    protected $repository;

    public function __construct(Specialty $specialty)
    {
        $this->repository = $specialty;
    }

    /**
     * Mostra lista de especialidades
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $specialties = $this->repository->paginate();

        return view('admin.specialties.index', ['specialties' => $specialties]);
    }

    /**
     * Mostra formulário de cadastro
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.specialties.create');
    }

    /**
     * Cadastra especialidade
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'specialty' => ['required'],
                'specialty_img' => ['required'],
            ],
            [
                'specialty.required' => 'O campo especialidade é obrigatório.',
                'specialty_img.required' => 'O campo imagem é obrigatório.'
            ]
        );

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $dados = $request->all();

        if ($request->hasFile('specialty_img') && $request->specialty_img->isValid()) {

            $ext = $request->specialty_img->extension();

            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                // SUBIR PARA SERVER AWS
                $folder = 'specialty/';
                $dados['uuid'] = Str::uuid();
                $name = $folder . $dados['uuid'] . '.' . $ext;
                $file = $request->file('specialty_img');
                Storage::disk('s3')->put($name, file_get_contents($file));
                $url = Storage::disk('s3')->url($name);
                $dados['specialty_img'] = $url;
            } else {
                return back()->with('toast_error', 'O formato de imagem é inválido!');
            }
        }

        $this->repository->create($dados);

        return redirect()->route('specialties.index')->with('toast_success', 'Especialidade criado');
    }

    /**
     * Mostra formulário de edição
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        if (!$specialty = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.specialties.edit', ['specialty' => $specialty]);
    }

    /**
     * Editar especialidade
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        if (!$specialty = $this->repository->find($id)) {
            return redirect()->back();
        }

        $validator  = Validator::make(
            $request->all(),
            [
                'specialty' => ['required'],
            ],
            [
                'specialty.required' => 'O campo especialidade é obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('specialty_img') && $request->specialty_img->isValid()) {

            $ext = $request->specialty_img->extension();

            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                // SUBIR PARA SERVER AWS
                $folder = 'specialty/';
                $name = $folder . $specialty->uuid . '.' . $ext;
                $file = $request->file('specialty_img');
                Storage::disk('s3')->put($name, file_get_contents($file));
                $url = Storage::disk('s3')->url($name);
                $data['specialty_img'] = $url;
            } else {
                return back()->with('toast_error', 'O formato de imagem é inválido!');
            }
        }

        $specialty->update($data);

        return redirect()->route('specialties.index')->with('toast_success', 'Especialidade atualizado');
    }

    /**
     * Deleta especialidade
     *
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        if (!$specialty = $this->repository->find($id)) {
            return back();
        }

        $url_cortada = substr($specialty->specialty_img, 47);

        if (Storage::disk('s3')->exists($url_cortada)) {
            Storage::disk('s3')->delete($url_cortada);
            $specialty->delete();

            return redirect()->route('specialties.index')->with('toast_success', 'Especialidade deletado');
        }

        return back()->with('toast_error', 'Erro ao deletar');
    }
}

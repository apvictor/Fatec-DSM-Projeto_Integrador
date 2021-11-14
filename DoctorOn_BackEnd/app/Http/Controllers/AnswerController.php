<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    private $repository;

    public function __construct(Answer $answer)
    {
        $this->repository = $answer;
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $credentials = $request->only(
            'resp',
        );

        //valid credential
        $validator = Validator::make($credentials, [
            'resp' => 'required',
        ]);

        if ($validator->fails()) {
            return view('list.message.index')->with('msg', $validator->messages());
        }

        $data = $request->except('_token');
        $data['admin_id'] = $user->id;

        $this->repository->create($data);

        return redirect()->route('list.message.index');
    }
}

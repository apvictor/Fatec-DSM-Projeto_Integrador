<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    private $repository;

    public function __construct(Message $message)
    {
        $this->repository = $message;
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $credentials = $request->only(
            'msg',
            'title',
        );

        //valid credential
        $validator = Validator::make($credentials, [
            'msg' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('suporte.index');
        }

        $data = $request->except('_token');
        $data['user_id'] = $user->id;

        $this->repository->create($data);

        return redirect()->route('suporte.index');
    }

    public function listIndex()
    {
        $user = Auth::user();
        $messages = Message::select('*')->latest('updated_at')->paginate(4);

        return view('list_message', compact('messages'));
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $user;
    private $repository;

    public function __construct(User $user)
    {
        // $this->user = JWTAuth::parseToken()->authenticate();
        $this->repository = $user;
    }

    public function profile(Request $request)
    {
        $user = JWTAuth::user();

        return response()->json(['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        //Validate data
        $data = $request->only('name', 'email');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update product
        $user = $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Usuário atualizado com sucesso',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {

        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'O usuário foi desconectado'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Desculpe, o usuário não pode ser desconectado'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // WEB
    public function index()
    {
        return view('user');
    }

    public function store(Request $request)
    {
        $credentials = $request->only(
            'name',
            'email',
            'password',
        );

        //valid credential
        $validator = Validator::make($credentials, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return view('user')->with('msg', $validator->messages());
        }

        $user = Auth::user();

        $data = $request->all();

        $data['units_id'] = $user->units_id;
        $data['type'] = 1;
        $data['password'] = bcrypt($request->password);
        // dd($data);
        $this->repository->create($data);

        return redirect()->route('home.index')->with('msg', 'Usuário cadastrado com sucesso!');
    }

    public function list()
    {
        $user = Auth::user();

        $users_all = User::select('*')
            ->where('units_id',  $user->units_id)
            ->latest("updated_at")
            ->paginate(4);

        return view('list_user', ['users_all' => $users_all]);
    }

    public function destroy($id)
    {
        $user = $this->repository->where('id', $id)->first();

        $user->delete();

        return redirect()->route('user.list.index');
    }

    public function updateWEB($id, Request $request)
    {
        $credentials = $request->only(
            'name',
            'email',
        );

        //valid credential
        $validator = Validator::make($credentials, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.list.index')->with('msg', $validator->messages());
        }

        $user = $this->repository->where('id', $id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.list.index')->with('msg', 'Usuário alterado com sucesso!');
    }
}

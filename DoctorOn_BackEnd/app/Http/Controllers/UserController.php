<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function profile(Request $request)
    {
        $user = JWTAuth::authenticate($request->token);

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
}

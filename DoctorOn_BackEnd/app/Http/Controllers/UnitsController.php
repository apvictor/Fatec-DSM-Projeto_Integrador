<?php

namespace App\Http\Controllers;

use App\Units;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UnitsController extends Controller
{

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return Units::select('*')->get();
    }

    public function show(Request $request)
    {
        return Units::select('*')->where('id', $request->id)->first();
    }
}

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
}

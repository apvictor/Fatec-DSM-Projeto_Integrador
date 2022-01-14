<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Time;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $address = Address::select('*')->where('units_id', $user->units_id)->first();
        $times = Time::select('*')->where('units_id', $user->units_id)->first();

        $totalUsers = User::where('units_id', $user->units_id)->count();
        $totalDoctors = Doctor::where('units_id', $user->units_id)->count();
        $totalDoctorsActives = Doctor::where('units_id', $user->units_id)->where('active', 1)->count();
        $totalSpecialties = Specialty::count();

        if ($user['units_id'] == null) {
            return view('admin.config.units.create');
        } else if ($address['units_id'] == null) {
            return view('admin.config.address.create');
        } else if ($times['units_id'] == null) {
            return view('admin.config.times.create');
        } else {
            return view('admin.home.index', [
                'totalUsers' => $totalUsers,
                'totalDoctors' => $totalDoctors,
                'totalDoctorsActives' => $totalDoctorsActives,
                'totalSpecialties' => $totalSpecialties,
            ]);
        }
    }
}

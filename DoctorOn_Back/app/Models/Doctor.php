<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'doctor',
        'crm',
        'sex',
        'doctor_img',
        'units_id',
        'specialties_id',
        'active',
    ];
}

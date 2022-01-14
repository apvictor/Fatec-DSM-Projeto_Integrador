<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'start_time',
        'end_time',
        'always_available',
        'units_id',
        'doctors_id',
    ];
}

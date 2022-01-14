<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'id',
        'specialty',
        'specialty_used',
        'specialty_img',
    ];
}

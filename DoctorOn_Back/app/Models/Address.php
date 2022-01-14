<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'cep',
        'street',
        'number',
        'district',
        'city',
        'state',
        'units_id',
    ];
}

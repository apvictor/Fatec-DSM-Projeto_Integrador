<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $fillable = [
        'unit', 'cep', 'km', 'street', 'number', 'district', 'start_time', 'end_time', 'always_available', 'phone'
    ];
}

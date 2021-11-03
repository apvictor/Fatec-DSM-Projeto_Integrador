<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'crm', 'sex', 'img_doctor', 'active', 'start_time', 'end_time', 'units_id', 'specialties_id'];
}

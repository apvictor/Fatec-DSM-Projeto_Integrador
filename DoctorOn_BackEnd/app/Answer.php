<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'resp', 'admin_id', 'msg_id'
    ];
}

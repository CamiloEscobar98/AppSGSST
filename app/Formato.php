<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    protected $fillable = ['user_id', 'info'];

    protected $casts = [
        'info' => 'array'
    ];
}

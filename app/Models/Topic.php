<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'info',
        'user_id'
    ];

    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}

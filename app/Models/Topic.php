<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'info'
    ];

    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable');
    }
}

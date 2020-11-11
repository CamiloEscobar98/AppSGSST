<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    protected $fillable = [
        'topic_id',
        'title',
        'info'
    ];

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class);
    }

    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable');
    }
}

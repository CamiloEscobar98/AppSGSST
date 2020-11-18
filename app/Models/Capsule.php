<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    protected $fillable = [
        'topic_id',
        'title',
        'info',
        'video'
    ];

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class);
    }
}

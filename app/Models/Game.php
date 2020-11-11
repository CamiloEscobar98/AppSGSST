<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'topic_id',
        'title',
        'type'
    ];

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class);
    }

    public function gameable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image', 'url'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function fullimage()
    {
        return $this->url . '/' . $this->image;
    }
}

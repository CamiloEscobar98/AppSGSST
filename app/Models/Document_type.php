<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    protected $fillable = [
        'type',
        'info'
    ];


    public function documents()
    {
        return $this->hasMany(\App\Models\Document::class);
    }
}

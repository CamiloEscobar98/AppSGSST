<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document_type_id',
        'document'
    ];

    public function document_type()
    {
        return $this->belongsTo(\App\Models\Document_type::class);
    }
}

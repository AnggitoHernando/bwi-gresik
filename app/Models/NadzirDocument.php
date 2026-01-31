<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NadzirDocument extends Model
{
    protected $fillable = [
        'nadzir_id',
        'type_document_id',
        'file_path',
        'is_verified',
        'is_verified',
    ];
}

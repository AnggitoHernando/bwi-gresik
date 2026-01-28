<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nadzir extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_nadzir',
        'nama_nadzir',
        'nama_lembaga',
        'kecamatan_id',
        'status',
    ];
}

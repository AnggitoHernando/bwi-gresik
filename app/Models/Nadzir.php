<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nadzir extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_nadzir_id',
        'nama_nadzir',
        'nama_lembaga',
        'kecamatan_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

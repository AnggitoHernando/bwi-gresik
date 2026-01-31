<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public function nadzir()
    {
        return $this->hasMany(Kecamatan::class, 'kecamatan_id');
    }
}

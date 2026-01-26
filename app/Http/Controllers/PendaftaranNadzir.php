<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PendaftaranNadzir extends Controller
{
    public function index()
    {
        $listKecamatan = Kecamatan::orderBy('nama_kecamatan')->get();
        return Inertia::render('Auth/Register', [
            'listKecamatan' => $listKecamatan
        ]);
    }
}

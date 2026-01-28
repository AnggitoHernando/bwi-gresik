<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rules;

class PendaftaranNadzir extends Controller
{
    public function index()
    {
        $listKecamatan = Kecamatan::orderBy('nama_kecamatan')->get();
        return Inertia::render('Auth/Register', [
            'listKecamatan' => $listKecamatan
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate(
            [
                'jenisNadzir' => [
                    'required',
                    'string',
                    'in:Perorangan,Lembaga,Badan'
                ],
                'namaNadzir' => 'required|string|max:255',
                'namaLembaga' => [
                    'nullable',
                    'string',
                    'min:3',
                    'max:150',
                    'required_if:jenisNadzir,Lembaga,Badan',
                ],
                'kecamatan' => 'required',
                'kecamatan.id' => [
                    'required',
                    'integer',
                    'exists:kecamatans,id',
                ],
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'kecamatan.required' => 'Kecamatan wajib dipilih.',
                'kecamatan.id.required' => 'Kecamatan wajib dipilih.',
                'kecamatan.id.exists' => 'Kecamatan tidak terdaftar.',
                'email.required' => 'Email wajib diisi.',
                'password.required' => 'Password wajib diisi.',
                'email.email' => 'Format email tidak valid.',
            ]
        );
    }
}

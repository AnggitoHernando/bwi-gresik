<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Nadzir;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                    'in:Perorangan,Organisasi,Badan Hukum'
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

        DB::transaction(function () use ($request) {
            $role = Role::where('name', 'nadzir')->firstOrFail();
            $user = User::create([
                'role_id' => $role->id,
                'name' => $request->namaNadzir,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $userId = $user->id;

            Nadzir::create([
                'user_id' => $userId,
                'nama_nadzir' => $request->namaNadzir,
                'jenis_nadzir' => $request->jenisNadzir,
                'nama_lembaga' => $request->namaLembaga,
                'status' => 'pending',
                'kecamatan_id' => $request->input('kecamatan.id'),
            ]);
        });
        return redirect()->back()->with('success', 'Pendaftaran Nadzir Berhasil');
    }
}

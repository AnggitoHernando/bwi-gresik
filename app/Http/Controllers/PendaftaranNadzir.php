<?php

namespace App\Http\Controllers;

use App\Models\JenisNadzir;
use App\Models\Kecamatan;
use App\Models\Nadzir;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PendaftaranNadzir extends Controller
{
    public function index()
    {
        $listKecamatan = Kecamatan::orderBy('nama_kecamatan')->get();
        $listJenisNadzir = JenisNadzir::select('id', 'nama')->where('is_active', 1)->where('nama', '!=', 'Semua')->get();
        return Inertia::render('Auth/Register', [
            'listKecamatan' => $listKecamatan,
            'listJenisNadzir' => $listJenisNadzir
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validated = $request->validate(
            [
                'jenisNadzir' => [
                    'required',
                    'string',
                    Rule::exists('jenis_nadzirs', 'nama')
                        ->where('is_active', 1),
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
            event(new Registered($user));

            Auth::login($user);

            $jenisNadzir = JenisNadzir::where('nama', $request->jenisNadzir)
                ->where('is_active', 1)
                ->firstOrFail();

            $jenisNadzirId = $jenisNadzir->id;

            Nadzir::create([
                'user_id' => $userId,
                'nama_nadzir' => $request->namaNadzir,
                'jenis_nadzir_id' => $jenisNadzirId,
                'nama_lembaga' => $request->namaLembaga,
                'status' => 'pending',
                'kecamatan_id' => $request->input('kecamatan.id'),
            ]);
        });
        return redirect()
            ->route('login')
            ->with('success', 'Pendaftaran Nadzir Berhasil');
    }
}

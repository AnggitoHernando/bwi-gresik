<?php

namespace App\Http\Controllers;

use App\Models\JenisNadzir;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class JenisNadzirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = JenisNadzir::query()
            ->where('nama', '!=', 'Semua')
            ->filter($request)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/JenisNadzir', [
            'items' => $items,
            'filters' => $request->only([
                'search',
                'sort',
                'direction',
                'from',
                'to',
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:150',
            ],
        ], [
            'nama.required' => 'Jenis nadzir wajib dipilih.',
        ]);


        JenisNadzir::create([
            'nama' => $validated['nama'],
        ]);

        return redirect()->back()->with('success', 'Jenis Nadzir Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function active(JenisNadzir $jenisNadzir)
    {
        $jenisNadzir->update([
            'is_active' => 1,
        ]);

        return back()->with('success', 'Status Berhasil Diperbaharui');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function nonActive(JenisNadzir $jenisNadzir)
    {
        $jenisNadzir->update([
            'is_active' => 0,
        ]);

        return back()->with('success', 'Status Berhasil Diperbaharui');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisNadzir $jenisNadzir)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('jenis_nadzirs', 'nama')->ignore($jenisNadzir->id),
            ],
        ]);

        $jenisNadzir->update([
            'nama' => $validated['nama'],
        ]);

        return back()->with('success', 'Nama jenis nadzir berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisNadzir $jenisNadzir)
    {
        $jenisNadzir->delete();

        return redirect()
            ->back()
            ->with('success', 'Data berhasil dihapus');
    }
}

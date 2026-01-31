<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $jenisNadzirId = $user->nadzir->jenis_nadzir_id;
        $userId = $user->id;
        $items = DB::table('type_documents as td')
            ->select([
                'td.id',
                'td.nama_dokumen',
                'td.template',
                'td.allowed_types',
                DB::raw("COALESCE(nd.file_path, '') as file_path"),
                DB::raw("
            CASE
                WHEN nd.file_path IS NULL THEN 'Belum Upload'
                WHEN nd.is_verified = 0 THEN 'Belum Diverifikasi'
                ELSE 'Disetujui'
            END as status_verifikasi
        ")
            ])

            ->join('jenis_nadzirs as jn', 'jn.id', '=', 'td.jenis_nadzir_id')

            ->leftJoin('nadzirs as n', function ($join) use ($userId) {
                $join->on('n.user_id', '=', DB::raw((int) $userId));
            })
            ->leftJoin('nadzir_documents as nd', function ($join) {
                $join->on('nd.nadzir_id', '=', 'n.id')
                    ->on('nd.type_document_id', '=', 'td.id');
            })
            ->where(function ($q) use ($jenisNadzirId) {
                $q->where('td.jenis_nadzir_id', $jenisNadzirId)
                    ->orWhere('jn.nama', 'Semua');
            })

            ->orderBy('td.id')
            ->get();

        return Inertia::render('Dashboard', [
            'items' => $items
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

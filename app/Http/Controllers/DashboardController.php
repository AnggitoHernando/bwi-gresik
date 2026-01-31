<?php

namespace App\Http\Controllers;

use App\Models\NadzirDocument;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $jenisNadzirId = $user->nadzir->jenis_nadzir_id ?? 0;
        $userId = $user->id;
        $items = DB::table('type_documents as td')
            ->select([
                'td.id',
                'td.nama_dokumen',
                'td.template',
                'td.allowed_types',
                'nd.id as nadzir_document_id',
                'nd.keterangan_penolakan',
                'nd.is_verified',
                DB::raw("COALESCE(nd.file_path, '') as file_path"),
                DB::raw("
            CASE
                WHEN nd.file_path IS NULL THEN 'Belum Upload'
                WHEN nd.is_verified = 0 THEN 'Belum Diverifikasi'
                WHEN (nd.keterangan_penolakan IS NOT NULL OR nd.keterangan_penolakan != '')  THEN 'Ditolak'
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

        $approved = $items->where('is_verified', 1)->filter(
            fn($item) =>
            is_null($item->keterangan_penolakan) || $item->keterangan_penolakan === ''
        )->count();
        $total = $items->count();
        $percent = $total === 0
            ? 0
            : (int) round(($approved / $total) * 100);
        $items = $items->map(function ($item) {
            $item->allowed_types = json_decode($item->allowed_types, true) ?? [];
            return $item;
        });


        return Inertia::render('Dashboard', [
            'listDokumen' => $items,
            'totalDokumen' => $total,
            'approved' => $approved,
            'percent' => $percent
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
        $document = TypeDocument::where('id', $request->typeDocumentId)->firstOrFail();
        $allowedTypes = $document->allowed_types;
        $nadzirDocumentId = $request->nadzirDocumentId;
        $rules = [
            'nadzirId' => [
                'required',
                Rule::exists('nadzirs', 'id'),
            ],
            'typeDocumentId' => [
                'required',
                Rule::exists('type_documents', 'id'),
            ],
            'filepath' => [
                'required',
                'file',
                'max:5120',
                'mimes:' . implode(',', $allowedTypes),
            ],

        ];
        if ($nadzirDocumentId) {
            $rules['nadzir_document_id'] = [
                'exists:nadzir_documents,id'
            ];
        }
        $validated = $request->validate($rules, [
            'filepath.required' => 'Harap Upload Dokumen',
            'filepath.mimes' => 'Format file harus: ' . strtoupper(implode(', ', $allowedTypes)),
        ]);


        $extension = "";
        $path = "";
        if ($request->hasFile('filepath')) {
            $file = $request->file('filepath');
            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            $safeName = Str::slug($originalName)
                . '-' . Carbon::now()->format('Ymd-His');

            $extension = $file->getClientOriginalExtension();

            $filename = $safeName . '.' . $extension;
            $path = $file->storeAs(
                "dokumen/{$request->nadzirId}",
                $filename,
                'public'
            );
        }

        if ($nadzirDocumentId) {
            $nadzirDocument = NadzirDocument::where('id', $nadzirDocumentId)
                ->where('nadzir_id', $validated['nadzirId'])
                ->firstOrFail();
            if ($nadzirDocument->is_verified == 1) {
                return redirect()->back()->withErrors('error', 'Dokumen sudah disetujui dan tidak dapat diunggah ulang.');
            }

            if ($nadzirDocument->file_path && Storage::disk('public')->exists($nadzirDocument->file_path)) {
                Storage::disk('public')->delete($nadzirDocument->file_path);
            }

            $nadzirDocument->update([
                'file_path' => $path,
                'is_verified' => 0,
            ]);
        } else {
            NadzirDocument::create([
                'nadzir_id' => $validated['nadzirId'],
                'type_document_id' => $validated['typeDocumentId'],
                'file_path'    => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Dokumen Berhasil Disimpan');
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

<?php

namespace App\Http\Controllers;

use App\Models\JenisNadzir;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TypeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = TypeDocument::query()
            ->filter($request)
            ->paginate(10)
            ->withQueryString();

        $listJenisNadzir = JenisNadzir::select('id', 'nama')->where('is_active', 1)->get();

        return Inertia::render('Admin/TypeDocument', [
            'items' => $items,
            'filters' => $request->only([
                'search',
                'sort',
                'direction',
                'from',
                'to',
            ]),
            'listJenisNadzir' => $listJenisNadzir
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
            'jenisNadzir' => [
                'required',
                'string',
                Rule::exists('jenis_nadzirs', 'nama')
                    ->where('is_active', 1),
            ],

            'namaDokumen' => [
                'required',
                'string',
                'max:150',
            ],
            'template' => [
                'nullable',
                'file',
                'max:5120',
                'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,zip',
            ],

        ], [
            'jenisNadzir.required' => 'Jenis nadzir wajib dipilih.',
            'namaDokumen.required' => 'Nama dokumen wajib diisi.',
        ]);

        $extension = "";
        $path = "";
        if ($request->hasFile('template')) {
            $file = $request->file('template');
            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            $safeName = Str::slug($originalName)
                . '-' . Carbon::now()->format('Ymd-His');

            $extension = $file->getClientOriginalExtension();

            $filename = $safeName . '.' . $extension;

            $path = $file->storeAs(
                "template-dokumen/{$request->jenisNadzir}",
                $filename,
                'public'
            );
        }

        $jenisNadzir = JenisNadzir::where('nama', $request->jenisNadzir)
            ->where('is_active', 1)
            ->firstOrFail();

        $jenisNadzirId = $jenisNadzir->id;

        TypeDocument::create([
            'jenis_nadzir_id' => $jenisNadzirId,
            'nama_dokumen' => $validated['namaDokumen'],
            'extension'    => $extension,
            'template'    => $path,
        ]);

        return redirect()->back()->with('success', 'Dokumen Template Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeDocument $typeDocument)
    {
        $validated = $request->validate([
            'jenisNadzir' => [
                'required',
                'string',
                Rule::exists('jenis_nadzirs', 'nama')
                    ->where('is_active', 1),
            ],
            'namaDokumen' => ['required', 'string'],
            'template' => [
                'nullable',
                'file',
                'max:5120',
                'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,zip',
            ],
        ]);

        $oldJenis = $typeDocument->jenis_nadzir_id;
        $newJenis = $validated['jenisNadzir'];

        $typeDocument->jenis_nadzir = $newJenis;
        $typeDocument->nama_dokumen = $validated['namaDokumen'];

        $basePath = 'template-dokumen/' . Str::slug($newJenis);

        if ($request->hasFile('template')) {
            $file = $request->file('template');

            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            $extension = $file->getClientOriginalExtension();

            $safeName = Str::slug($originalName)
                . '-' . now()->format('YmdHis');

            $filename = $safeName . '.' . $extension;

            if ($typeDocument->template && Storage::disk('public')->exists($typeDocument->template)) {
                Storage::disk('public')->delete($typeDocument->template);
            }

            $path = $file->storeAs($basePath, $filename, 'public');
            $typeDocument->template = $path;
        } elseif (
            $oldJenis !== $newJenis &&
            $typeDocument->template &&
            Storage::disk('public')->exists($typeDocument->template)
        ) {
            $filename = basename($typeDocument->template);
            $newPath = $basePath . '/' . $filename;

            Storage::disk('public')->move($typeDocument->template, $newPath);
            $typeDocument->template = $newPath;
        }

        $typeDocument->save();

        return back()->with('success', 'Dokumen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeDocument $typeDocument)
    {
        if ($typeDocument->template && Storage::disk('public')->exists($typeDocument->template)) {
            Storage::disk('public')->delete($typeDocument->template);
        }

        $typeDocument->delete();

        return redirect()
            ->back()
            ->with('success', 'Dokumen berhasil dihapus');
    }
}

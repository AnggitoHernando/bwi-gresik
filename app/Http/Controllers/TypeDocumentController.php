<?php

namespace App\Http\Controllers;

use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        return Inertia::render('Admin/TypeDocument', [
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
            'jenisNadzir' => [
                'required',
                'string',
                'in:Perorangan,Organisasi,Badan Hukum,Semua'
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
            $safeName = Str::slug($originalName);

            $extension = $file->getClientOriginalExtension();

            $filename = $safeName . '.' . $extension;

            $path = $file->storeAs(
                "template-dokumen/{$request->jenisNadzir}",
                $filename,
                'public'
            );
        }

        TypeDocument::create([
            'jenis_nadzir' => $validated['jenisNadzir'],
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeDocument $typeDocument)
    {
        //
    }
}

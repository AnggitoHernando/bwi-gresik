<?php

namespace App\Http\Controllers;

use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        //
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

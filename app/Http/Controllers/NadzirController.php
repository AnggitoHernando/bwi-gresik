<?php

namespace App\Http\Controllers;

use App\Models\Nadzir;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NadzirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Nadzir::query()
            ->with('kecamatan:id,nama_kecamatan')
            ->with('jenisNadzir:id,nama')
            ->filter($request)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Nadzir', [
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
    public function show(Nadzir $nadzir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nadzir $nadzir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nadzir $nadzir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nadzir $nadzir)
    {
        //
    }
}

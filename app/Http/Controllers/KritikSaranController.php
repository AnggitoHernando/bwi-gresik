<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KritikSaranController extends Controller
{
    public function index(Request $request)
    {
        $items = KritikSaran::query()
            ->filter($request)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/KritikSaranAdmin', [
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

    public function destroy($id)
    {
        $data = KritikSaran::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Kritik & Saran berhasil dihapus.');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string|max:5000',
        ]);

        KritikSaran::create([
            'nama'       => $validated['nama'] ?? null,
            'pesan'      => $validated['pesan'],
            'email'      => $validated['email'],
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Kritik & Saran berhasil disimpan.');
    }
}

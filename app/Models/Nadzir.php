<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Nadzir extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_nadzir_id',
        'nama_nadzir',
        'nama_lembaga',
        'kecamatan_id',
        'status',
    ];
    public function scopeFilter(Builder $query, Request $request): Builder
    {
        $sortable = [
            'created_at' => 'type_documents.created_at',
            'jenis_nadzir' => 'jenis_nadzirs.nama',
            'kecamatan' => 'kecamatans.nama_kecamatan',
        ];
        return $query
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_nadzir', 'like', "%{$search}%")
                        ->orWhere('nama_lembaga', 'like', "%{$search}%");
                });
            })

            ->when($request->from, function ($q, $from) {
                $q->whereDate('created_at', '>=', $from);
            })

            ->when($request->to, function ($q, $to) {
                $q->whereDate('created_at', '<=', $to);
            })

            ->when($request->sort, function ($q) use ($request, $sortable) {
                $sort = $request->sort;
                $direction = $request->get('direction', 'asc');

                if ($sort === 'jenis_nadzir') {
                    $q->leftJoin(
                        'jenis_nadzirs',
                        'nadzirs.jenis_nadzir_id',
                        '=',
                        'jenis_nadzirs.id'
                    );
                }

                if ($sort === 'kecamatan') {
                    $q->leftJoin(
                        'kecamatans',
                        'nadzirs.kecamatan_id',
                        '=',
                        'kecamatans.id'
                    );
                }

                $q->orderBy($sortable[$sort] ?? 'nadzirs.created_at', $direction)
                    ->select('nadzirs.*');
            });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    public function jenisNadzir()
    {
        return $this->belongsTo(JenisNadzir::class, 'jenis_nadzir_id');
    }
}

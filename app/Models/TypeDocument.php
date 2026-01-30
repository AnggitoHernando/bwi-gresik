<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TypeDocument extends Model
{
    protected $fillable = [
        'jenis_nadzir_id',
        'nama_dokumen',
        'type_dokumen',
        'extension',
        'template',
    ];
    public function scopeFilter(Builder $query, Request $request): Builder
    {
        $sortable = [
            'nama' => 'type_documents.nama',
            'created_at' => 'type_documents.created_at',
            'jenis_nadzir' => 'jenis_nadzirs.nama',
        ];
        return $query
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_dokumen', 'like', "%{$search}%")
                        ->orWhereHas('jenisNadzir', function ($q) use ($search) {
                            $q->where('nama', 'like', "%{$search}%");
                        });
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
                        'type_documents.jenis_nadzir_id',
                        '=',
                        'jenis_nadzirs.id'
                    );
                }

                $q->orderBy($sortable[$sort] ?? 'type_documents.created_at', $direction)
                    ->select('type_documents.*');
            });
    }

    public function jenisNadzir()
    {
        return $this->belongsTo(JenisNadzir::class, 'jenis_nadzir_id');
    }
}

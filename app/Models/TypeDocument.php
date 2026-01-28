<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TypeDocument extends Model
{
    protected $fillable = [
        'jenis_nadzir',
        'nama_dokumen',
        'type_dokumen',
        'extension',
        'template',
    ];
    public function scopeFilter(Builder $query, Request $request): Builder
    {
        return $query
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('nama_dokumen', 'like', "%{$search}%");
                });
            })

            ->when($request->from, function ($q, $from) {
                $q->whereDate('created_at', '>=', $from);
            })

            ->when($request->to, function ($q, $to) {
                $q->whereDate('created_at', '<=', $to);
            })

            ->when(
                $request->sort,
                function ($q, $sort) use ($request) {
                    $direction = $request->get('direction', 'asc');
                    $q->orderBy($sort, $direction);
                },
                function ($q) {
                    $q->latest();
                }
            );
    }
}

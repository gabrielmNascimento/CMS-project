<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait WhereLike
{
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where(DB::raw("unaccent($column)"), 'ILIKE', '%'.
            transliterator_transliterate('Any-Latin; Latin-ASCII', $value) .'%');
    }
}

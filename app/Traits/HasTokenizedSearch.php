<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

trait HasTokenizedSearch
{

    public function scopeTokenizedSearch(
        Builder $query, string $search, array $fields
    ): Builder {
        foreach (explode(' ',$search) as $word){
            $query->where(function($query) use ($fields, $word) {
                $query->where(DB::raw('LOWER('.$fields[0].')'), 'like', "%{$word}%");
                foreach (array_slice($fields,1) as $field){
                    $query->orWhere(DB::raw('LOWER('.$field.')'), 'like', "%{$word}%");
                }
            });
        }
        return $query;
    }
}

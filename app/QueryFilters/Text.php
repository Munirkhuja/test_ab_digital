<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class Text
{
    public function handle(Builder $query, $next)
    {
        if (request()->has('text')) {
            $query->where('text', 'LIKE', '%' . request('text') . '%');
        }

        return $next($query);
    }
}

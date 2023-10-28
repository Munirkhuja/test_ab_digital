<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class CursorPaginateLoc
{
    public function handle(Builder $query, $next)
    {
        if (request()->has('limit') && request('limit') < config('ab-digital.max_limit')) {
            $limit = request('limit');
        } else {
            $limit = config('ab-digital.limit');
        }

        return $next($query->cursorPaginate($limit)->withQueryString());
    }
}

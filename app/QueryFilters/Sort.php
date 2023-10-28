<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class Sort
{
    public function handle(Builder $query, $next)
    {
        if (request()->has('sort')) {
            $sort_array = explode(',', request('sort'));
            if (count($sort_array) > 0) {
                foreach ($sort_array as $sort_column) {
                    $query = $this->sort_private($query, $sort_column);
                }
            } else {
                $query = $this->sort_private($query, request('sort'));
            }
        } else {
            $query->orderBy('id', 'desc');
        }

        return $next($query);
    }

    private function sort_private(Builder $query, $sort_column): Builder
    {
        $asc_desc = 'asc';
        if (str_starts_with($sort_column, '-')) {
            $sort_column = substr($sort_column, 1);
            $asc_desc = 'desc';
        }

        return $query->orderBy($sort_column, $asc_desc);
    }
}

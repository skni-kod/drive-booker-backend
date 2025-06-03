<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FullNameFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        $value = strtolower(trim($value));

        $parts = preg_split('/\s+/', $value); // rozdzielenie po spacjach (zeby wyszukiwalo jesli podamy i imie, i nazwisko)

        $query->where(function ($q) use ($parts) {
            if (count($parts) === 1) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$parts[0]}%"])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$parts[0]}%"]);
            } else {
                foreach ($parts as $part) {
                    $q->where(function ($subQ) use ($part) {
                        $subQ->whereRaw('LOWER(name) LIKE ?', ["%{$part}%"])
                            ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$part}%"]);
                    });
                }
            }
        });
    }
}

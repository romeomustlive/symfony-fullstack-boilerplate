<?php

declare(strict_types=1);


namespace App\Presentation\Records\Filters\Result\Eloquent;


use App\Presentation\Records\Filters\Result\FromDateFilter;

final class EloquentFromDateFilter implements FromDateFilter
{
    public function filter($qs, $value)
    {
        return $qs->where('created_at', '>=', $value);
    }
}

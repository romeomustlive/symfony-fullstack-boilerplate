<?php

declare(strict_types=1);


namespace App\Presentation\Records\Filters\Result\Eloquent;


use App\Presentation\Records\Filters\Result\ToDateFilter;
use Carbon\Carbon;

class EloquentToDateFilter implements ToDateFilter
{
    public function filter($qs, $value)
    {
        return $qs->where('created_at', '<=', Carbon::createFromDate($value)->endOfDay());
    }
}

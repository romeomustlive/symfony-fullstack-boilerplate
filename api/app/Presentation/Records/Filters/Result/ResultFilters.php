<?php

declare(strict_types=1);


namespace App\Presentation\Records\Filters\Result;


use App\Infrastructure\Filters\AbstractFilters;


class ResultFilters extends AbstractFilters
{
    protected array $filters = [
        'exercise' => ExerciseFilter::class,
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class
    ];
}

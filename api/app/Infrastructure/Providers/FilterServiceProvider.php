<?php

declare(strict_types=1);


namespace App\Infrastructure\Providers;


use App\Presentation\Records\Filters\Result\Eloquent\EloquentExerciseFilter;
use App\Presentation\Records\Filters\Result\Eloquent\EloquentFromDateFilter;
use App\Presentation\Records\Filters\Result\Eloquent\EloquentToDateFilter;
use App\Presentation\Records\Filters\Result\ExerciseFilter;
use App\Presentation\Records\Filters\Result\FromDateFilter;
use App\Presentation\Records\Filters\Result\ToDateFilter;
use Carbon\Laravel\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerBindings();
    }

    private function registerBindings()
    {
        $this->app->bind(
            ExerciseFilter::class,
            EloquentExerciseFilter::class
        );
        $this->app->bind(
            FromDateFilter::class,
            EloquentFromDateFilter::class
        );
        $this->app->bind(
            ToDateFilter::class,
            EloquentToDateFilter::class
        );
    }
}

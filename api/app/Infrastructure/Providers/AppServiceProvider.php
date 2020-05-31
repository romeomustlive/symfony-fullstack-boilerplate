<?php

namespace App\Infrastructure\Providers;


use App\Core\Auth\Storage\UserStorage;
use App\Core\Records\Queries\ExerciseQuery;
use App\Core\Records\Queries\ResultQuery;
use App\Core\Records\Storage\ExerciseStorage;
use App\Core\Records\Storage\ResultStorage;
use App\Infrastructure\Persistence\Eloquent\Queries\EloquentExerciseQuery;
use App\Infrastructure\Persistence\Eloquent\Queries\EloquentResultQuery;
use App\Infrastructure\Persistence\Eloquent\Storage\EloquentExerciseStorage;
use App\Infrastructure\Persistence\Eloquent\Storage\EloquentResultStorage;
use App\Infrastructure\Persistence\Eloquent\Storage\EloquentUserStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    private function registerBindings()
    {
        $this->app->bind(
            UserStorage::class,
            EloquentUserStorage::class
        );
        $this->app->bind(
            ExerciseStorage::class,
            EloquentExerciseStorage::class
        );
        $this->app->bind(
            ExerciseQuery::class,
            EloquentExerciseQuery::class
        );
        $this->app->bind(
            ResultStorage::class,
            EloquentResultStorage::class
        );
        $this->app->bind(
            ResultQuery::class,
            EloquentResultQuery::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\Eloquent\Storage;


use App\Core\Auth\Models\User;
use App\Core\Auth\Storage\UserStorage;
use App\Infrastructure\Persistence\Eloquent\AbstractEloquentStorage;

final class EloquentUserStorage extends AbstractEloquentStorage implements UserStorage
{
    protected $model = User::class;
}

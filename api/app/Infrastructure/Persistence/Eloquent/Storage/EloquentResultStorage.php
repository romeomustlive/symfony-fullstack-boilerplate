<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\Eloquent\Storage;


use App\Core\Records\Models\Result;
use App\Core\Records\Storage\ResultStorage;
use App\Infrastructure\Persistence\Eloquent\AbstractEloquentStorage;

final class EloquentResultStorage extends AbstractEloquentStorage implements ResultStorage
{
    protected $model = Result::class;
}

<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence;


interface BaseStorage
{
    public function getAll();

    public function getById(int $id);

    public function save($model);

    public function delete($model);
}

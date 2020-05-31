<?php

declare(strict_types=1);


namespace App\Core\Records\Queries;


interface ExerciseQuery
{
    public function getAll();

    public function getAllByUser(int $userId);

    public function getById(int $id);
}

<?php

declare(strict_types=1);


namespace App\Core\Records\Factories;


use App\Core\Records\DTO\ExerciseDTO;
use App\Core\Records\Models\Exercise;

final class ExerciseFactory
{
    public function create(string $name, ?string $description)
    {
        return new Exercise([
            'name' => $name,
            'description' => $description
        ]);
    }
}

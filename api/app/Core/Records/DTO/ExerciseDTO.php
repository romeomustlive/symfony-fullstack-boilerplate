<?php

declare(strict_types=1);


namespace App\Core\Records\DTO;


use Spatie\DataTransferObject\DataTransferObject;

final class ExerciseDTO extends DataTransferObject
{
    public ?string $name;

    public ?string $description;
}

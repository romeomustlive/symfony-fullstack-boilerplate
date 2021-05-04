<?php


namespace App\Sport\Exercise\Infrastructure\Persistence\Doctrine;


use App\Shared\Infrastructure\Persistence\Doctrine\UuidType;
use App\Sport\Exercise\Domain\ExerciseId;

final class ExerciseIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ExerciseId::class;
    }
}
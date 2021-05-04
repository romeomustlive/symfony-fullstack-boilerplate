<?php


namespace App\Sport\Exercise\Domain;


use App\Shared\Domain\DomainError;

final class ExerciseNotFound extends DomainError
{
    public function errorCode(): string
    {
        return 'exercise_not_found';
    }

    protected function errorMessage(): string
    {
        return 'Exercise not found.';
    }
}
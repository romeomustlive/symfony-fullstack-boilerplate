<?php


namespace App\Sport\Exercise\Domain;


use App\Shared\Domain\Criteria\Criteria;

interface ExerciseRepository
{
    public function save(Exercise $exercise): void;

    public function search(ExerciseId $id): ?Exercise;

    public function matching(Criteria $criteria): array;

    public function delete(Exercise $exercise): void;
}
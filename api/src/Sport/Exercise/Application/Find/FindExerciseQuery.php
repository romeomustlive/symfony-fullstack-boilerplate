<?php


namespace App\Sport\Exercise\Application\Find;


use App\Shared\Domain\Bus\Query\Query;

final class FindExerciseQuery implements Query
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
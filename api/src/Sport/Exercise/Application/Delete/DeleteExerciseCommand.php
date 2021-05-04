<?php


namespace App\Sport\Exercise\Application\Delete;


use App\Shared\Domain\Bus\Command\Command;

final class DeleteExerciseCommand implements Command
{
    private ?string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
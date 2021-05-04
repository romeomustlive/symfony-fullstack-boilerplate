<?php


namespace App\Sport\Exercise\Application\Update;


use App\Shared\Domain\Bus\Command\Command;

final class UpdateExerciseCommand implements Command
{
    private ?string $id;
    private ?string $title;
    private ?string $description;

    public function __construct(?string $id, ?string $title, ?string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function description(): ?string
    {
        return $this->description;
    }
}
<?php


namespace App\Sport\Exercise\Application\Create;


use App\Shared\Domain\Bus\Command\Command;

final class CreateExerciseCommand implements Command
{
    private string $id;
    private string $title;
    private string $description;
    private string $userId;

    public function __construct(string $id, string $title, string $description, string $userId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->userId = $userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
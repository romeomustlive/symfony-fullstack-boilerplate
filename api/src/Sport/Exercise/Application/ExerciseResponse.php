<?php


namespace App\Sport\Exercise\Application;


use App\Shared\Domain\Bus\Query\Response;

final class ExerciseResponse implements Response
{
    private string $id;
    private string $title;
    private string $description;

    public function __construct(string $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
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
}
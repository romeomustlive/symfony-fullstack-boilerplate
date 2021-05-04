<?php


namespace App\Sport\Exercise\Application;


use App\Shared\Domain\Bus\Query\Response;

final class ExercisesResponse implements Response
{
    private array $exercises;
    private int $pageCount;
    private int $totalItems;

    public function __construct(int $pageCount, int $totalItems, ExerciseResponse ...$exercises)
    {
        $this->exercises = $exercises;
        $this->pageCount = $pageCount;
        $this->totalItems = $totalItems;
    }

    public function exercises(): array
    {
        return $this->exercises;
    }

    public function pageCount(): int
    {
        return $this->pageCount;
    }

    public function totalItems(): int
    {
        return $this->totalItems;
    }
}
<?php


namespace App\Sport\Result\Application;


use App\Shared\Domain\Bus\Query\Response;

final class ResultsResponse implements Response
{
    private array $results;
    private ?int $totalItems;
    private ?int $pagesCount;

    public function __construct(?int $totalItems, ?int $pagesCount, ResultResponse ...$results)
    {
        $this->totalItems = $totalItems;
        $this->pagesCount = $pagesCount;
        $this->results = $results;
    }

    public function totalItems(): ?int
    {
        return $this->totalItems;
    }

    public function pagesCount(): ?int
    {
        return $this->pagesCount;
    }

    public function results(): array
    {
        return $this->results;
    }
}
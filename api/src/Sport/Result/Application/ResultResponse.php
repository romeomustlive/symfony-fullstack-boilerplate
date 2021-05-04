<?php


namespace App\Sport\Result\Application;


use App\Shared\Domain\Bus\Query\Response;

final class ResultResponse implements Response
{
    private ?string $id;
    private ?string $weight;
    private ?string $count;
    private ?string $createdAt;
    private ?string $exerciseTitle;

    public function __construct(?string $id, ?string $weight, ?string $count, ?string $createdAt, ?string $exerciseTitle)
    {
        $this->id = $id;
        $this->weight = $weight;
        $this->count = $count;
        $this->createdAt = $createdAt;
        $this->exerciseTitle = $exerciseTitle;
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function weight(): ?string
    {
        return $this->weight;
    }

    public function count(): ?string
    {
        return $this->count;
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }

    public function exerciseTitle(): ?string
    {
        return $this->exerciseTitle;
    }
}
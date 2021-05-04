<?php


namespace App\Sport\Result\Application\Create;


use App\Shared\Domain\Bus\Command\Command;

final class CreateResultCommand implements Command
{
    private ?string $id;
    private ?float $weight;
    private ?int $count;
    private ?string $exerciseId;
    private ?string $userId;

    public function __construct(?string $id, ?float $weight, ?int $count, ?string $exerciseId, ?string $userId)
    {
        $this->id = $id;
        $this->weight = $weight;
        $this->count = $count;
        $this->exerciseId = $exerciseId;
        $this->userId = $userId;
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function weight(): ?float
    {
        return $this->weight;
    }

    public function count(): ?int
    {
        return $this->count;
    }

    public function exerciseId(): ?string
    {
        return $this->exerciseId;
    }

    public function userId(): ?string
    {
        return $this->userId;
    }
}
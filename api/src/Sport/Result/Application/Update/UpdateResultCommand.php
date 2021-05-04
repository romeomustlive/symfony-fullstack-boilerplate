<?php


namespace App\Sport\Result\Application\Update;


use App\Shared\Domain\Bus\Command\Command;
use App\Sport\Result\Domain\ResultId;

final class UpdateResultCommand implements Command
{
    private ?string $id;
    private ?string $weight;
    private ?string $count;
    private ?string $exerciseId;

    public function __construct(?string $id, ?string $weight, ?string $count, ?string $exerciseId)
    {
        $this->id = $id;
        $this->weight = $weight;
        $this->count = $count;
        $this->exerciseId = $exerciseId;
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

    public function exerciseId(): ?string
    {
        return $this->exerciseId();
    }
}
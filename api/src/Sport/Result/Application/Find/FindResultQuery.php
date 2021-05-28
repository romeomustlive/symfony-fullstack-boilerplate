<?php


namespace App\Sport\Result\Application\Find;


use App\Shared\Domain\Bus\Query\Query;

final class FindResultQuery implements Query
{
    private ?string $id;

    public function __construct(?string $id)
    {
        $this->id = $id;
    }

    public function id(): ?string
    {
        return $this->id;
    }
}
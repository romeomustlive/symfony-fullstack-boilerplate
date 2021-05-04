<?php


namespace App\Sport\Result\Application\Find;


final class FindResultQuery
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
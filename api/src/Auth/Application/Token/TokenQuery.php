<?php


namespace App\Auth\Application\Token;


use App\Shared\Domain\Bus\Query\Query;

final class TokenQuery implements Query
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function email(): string
    {
        return $this->email;
    }
}
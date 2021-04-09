<?php


namespace App\Auth\Application\Token;


use App\Shared\Domain\Bus\Query\Response;

final class TokenResponse implements Response
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function token(): string
    {
        return $this->token;
    }
}
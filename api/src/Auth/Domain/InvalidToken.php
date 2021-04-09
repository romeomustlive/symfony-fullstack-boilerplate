<?php


namespace App\Auth\Domain;


use App\Shared\Domain\DomainError;

final class InvalidToken extends DomainError
{
    public function errorCode(): string
    {
        return 'invalid_token';
    }

    protected function errorMessage(): string
    {
        return 'Invalid token.';
    }
}
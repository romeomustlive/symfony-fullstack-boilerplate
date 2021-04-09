<?php


namespace App\Auth\Domain;


use App\Shared\Domain\DomainError;

final class InvalidCredentials extends DomainError
{
    public function errorCode(): string
    {
        return 'invalid_credentials';
    }

    protected function errorMessage(): string
    {
        return 'Invalid credentials';
    }
}
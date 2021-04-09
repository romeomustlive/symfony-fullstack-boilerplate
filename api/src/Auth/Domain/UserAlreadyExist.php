<?php


namespace App\Auth\Domain;


use App\Shared\Domain\DomainError;

final class UserAlreadyExist extends DomainError
{
    public function errorCode(): string
    {
        return 'user_already_exist';
    }

    protected function errorMessage(): string
    {
        return 'User already exist.';
    }
}
<?php


namespace App\Sport\Result\Domain;


use App\Shared\Domain\DomainError;

final class ResultNotFound extends DomainError
{
    public function errorCode(): string
    {
        return 'result_not_found';
    }

    protected function errorMessage(): string
    {
        return 'Result not Found.';
    }
}
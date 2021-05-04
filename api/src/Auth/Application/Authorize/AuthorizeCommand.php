<?php


namespace App\Auth\Application\Authorize;


use App\Shared\Domain\Bus\Command\Command;

final class AuthorizeCommand implements Command
{
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function username(): string
    {
        return $this->username;
    }
}
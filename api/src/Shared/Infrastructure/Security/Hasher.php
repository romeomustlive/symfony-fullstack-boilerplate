<?php


namespace App\Shared\Infrastructure\Security;


final class Hasher
{
    public static function hash(string $value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }
}
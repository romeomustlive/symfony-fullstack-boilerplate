<?php


namespace App\Auth\Infrastructure\Persistence\Doctrine;


use App\Auth\Domain\UserId;
use App\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class UserIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return UserId::class;
    }
}
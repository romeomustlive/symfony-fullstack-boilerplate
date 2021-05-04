<?php


namespace App\Sport\Result\Infrastructure\Persistence\Doctrine;


use App\Shared\Infrastructure\Persistence\Doctrine\UuidType;
use App\Sport\Result\Domain\ResultId;

final class ResultIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ResultId::class;
    }
}
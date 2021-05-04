<?php


namespace App\Shared\Domain\Criteria;


use App\Shared\Domain\ValueObject\Enum;
use InvalidArgumentException;


final class OrderType extends Enum
{
    public const ASC = 'asc';
    public const DESC = 'desc';
    public const NONE = 'none';

    public function isNone(): bool
    {
        return $this->equals(self::none());
    }

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidArgumentException($value);
    }

    public static function none(): OrderType
    {
        return new self(OrderType::NONE);
    }

    public static function asc(): OrderType
    {
        return new self(OrderType::ASC);
    }

    public static function desc(): OrderType
    {
        return new self(OrderType::DESC);
    }
}
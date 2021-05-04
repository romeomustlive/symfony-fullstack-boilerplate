<?php


namespace App\Shared\Domain\Criteria;


use App\Shared\Domain\ValueObject\Enum;
use InvalidArgumentException;

final class FilterOperator extends Enum
{
    public const EQUAL = '=';
    public const NOT_EQUAL = '!=';
    public const GT = '>';
    public const LT = '<';
    public const CONTAINS = 'CONTAINS';
    public const NOT_CONTAINS = 'NOT_CONTAINS';
    public const LIKE = 'LIKE';
    private static array $containing = [self::CONTAINS, self::NOT_CONTAINS];

    public function isContaining(): bool
    {
        return in_array($this->value(), self::$containing, true);
    }

    protected function throwExceptionForInvalidValue($value): void
    {
        throw new InvalidArgumentException(sprintf('The filter <%s> is invalid', $value));
    }
}
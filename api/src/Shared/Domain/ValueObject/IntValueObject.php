<?php


namespace App\Shared\Domain\ValueObject;


abstract class IntValueObject
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
<?php


namespace App\Shared\Domain\ValueObject;


abstract class FloatValueObject
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
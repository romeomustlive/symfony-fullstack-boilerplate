<?php


namespace App\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as Ramsey;
use InvalidArgumentException;

class Uuid
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidUuid($value);
        $this->value = $value;
    }

    public static function random(): self
    {
        return new self(Ramsey::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function ensureIsValidUuid(string $id)
    {
        if (!Ramsey::isValid($id)) {
            throw new InvalidArgumentException(sprintf('Uuid %s is not valid', $id));
        }
    }
}
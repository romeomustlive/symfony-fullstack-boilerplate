<?php


namespace App\Shared\Domain\ValueObject;


use App\Shared\Domain\Utils;
use ReflectionClass;
use function Lambdish\Phunctional\reindex;

abstract class Enum
{
    protected static array $cache = [];
    /** @var mixed */
    protected $value;

    public function __construct($value)
    {
        $this->ensureIsBetweenAcceptedValues($value);
        $this->value = $value;
    }

    abstract protected function throwExceptionForInvalidValue($value);

    public static function values(): array
    {
        $class = static::class;

        if (!isset(self::$cache[$class])) {
            $reflected = new ReflectionClass($class);
            self::$cache[$class] = reindex(self::keysFormatter(), $reflected->getConstants());
        }

        return self::$cache[$class];
    }

    private static function keysFormatter(): callable
    {
        return static fn($unused, string $key): string => Utils::toCamelCase(strtolower($key));
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(Enum $other): bool
    {
        return $other == $this;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    private function ensureIsBetweenAcceptedValues($value): void
    {
        if (!in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }
}
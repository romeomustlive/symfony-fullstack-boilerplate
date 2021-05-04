<?php


namespace App\Shared\Domain\Criteria;


use App\Shared\Domain\Collection;

final class Filters extends Collection
{
    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    private static function filterBuilder(): callable
    {
        return fn(array $values) => Filter::fromValues($values);
    }

    protected function type(): string
    {
        return Filter::class;
    }

    public function filters(): array
    {
        return $this->items();
    }
}
<?php


namespace App\Shared\Domain;


use ArrayIterator;
use Countable;
use Exception;
use IteratorAggregate;
use Traversable;

abstract class Collection implements Countable, IteratorAggregate
{
    private array $items;

    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);
        $this->items = $items;
    }

    abstract protected function type(): string;

    public function count(): int
    {
        return count($this->items());
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    protected function items(): array
    {
        return $this->items;
    }
}
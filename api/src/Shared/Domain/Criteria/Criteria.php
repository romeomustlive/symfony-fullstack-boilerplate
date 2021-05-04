<?php


namespace App\Shared\Domain\Criteria;


final class Criteria
{
    private Filters $filters;
    private Order $order;
    private ?int $page;
    private ?int $pageSize;

    public function __construct(Filters $filters, Order $order, ?int $page, ?int $pageSize)
    {
        $this->filters = $filters;
        $this->order = $order;
        $this->page = $page;
        $this->pageSize = $pageSize;
    }

    public function filters(): Filters
    {
        return $this->filters;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function page(): ?int
    {
        return $this->page;
    }

    public function pageSize(): ?int
    {
        return $this->pageSize;
    }

    public function hasFilters(): bool
    {
        return $this->filters->count() > 0;
    }

    public function hasOrder(): bool
    {
        return !$this->order->isNone();
    }

    public function hasPage(): bool
    {
        return null !== $this->page;
    }

    public function plainFilters(): array
    {
        return $this->filters()->filters();
    }
}
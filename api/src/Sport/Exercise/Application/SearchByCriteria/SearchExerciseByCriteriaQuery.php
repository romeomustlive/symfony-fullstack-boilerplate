<?php


namespace App\Sport\Exercise\Application\SearchByCriteria;


use App\Shared\Domain\Bus\Query\Query;

final class SearchExerciseByCriteriaQuery implements Query
{
    private ?string $userId;
    private ?string $title;
    private ?string $orderBy;
    private ?string $order;
    private ?int $page;
    private ?int $pageSize;

    public function __construct(?string $userId, ?string $title, ?string $orderBy, ?string $order, ?int $page, ?int $pageSize)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->orderBy = $orderBy;
        $this->order = $order;
        $this->page = $page ?: 1;
        $this->pageSize = $pageSize ?: 10;
    }

    public function userId(): ?string
    {
        return $this->userId;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function order(): ?string
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
}
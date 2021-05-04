<?php


namespace App\Shared\Domain\Criteria;


final class Order
{
    private OrderBy $orderBy;
    private OrderType $orderType;

    public function __construct(OrderBy $orderBy, OrderType $orderType)
    {
        $this->orderBy = $orderBy;
        $this->orderType = $orderType;
    }

    public static function createDesc(OrderBy $orderBy): Order
    {
        return new self($orderBy, OrderType::desc());
    }

    public static function fromValues(?string $orderBy, ?string $orderType): Order
    {
        return null === $orderBy ? self::none() : new Order(new OrderBy($orderBy), new OrderType($orderType));
    }

    public static function none(): Order
    {
        return new Order(new OrderBy(''), OrderType::none());
    }

    public function orderBy(): OrderBy
    {
        return $this->orderBy;
    }

    public function orderType(): OrderType
    {
        return $this->orderType;
    }

    public function isNone(): bool
    {
        return $this->orderType()->isNone();
    }
}
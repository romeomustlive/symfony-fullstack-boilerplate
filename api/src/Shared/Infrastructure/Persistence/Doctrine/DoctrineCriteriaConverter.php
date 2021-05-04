<?php


namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filter;
use Doctrine\Common\Collections\Criteria as DoctrineCriteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;

final class DoctrineCriteriaConverter
{
    private Criteria $criteria;

    public function __construct(Criteria $criteria)
    {
        $this->criteria = $criteria;
    }

    public static function convert(Criteria $criteria): DoctrineCriteria
    {
        $converter = new self($criteria);

        return $converter->convertToDoctrineCriteria();
    }

    private function convertToDoctrineCriteria(): DoctrineCriteria
    {
        return new DoctrineCriteria(
            $this->buildExpression($this->criteria),
            $this->formatOrder($this->criteria)
        );
    }

    private function buildExpression(Criteria $criteria): ?CompositeExpression
    {
        if ($criteria->hasFilters()) {
            return new CompositeExpression(
                CompositeExpression::TYPE_AND,
                array_map($this->buildComparison(), $criteria->plainFilters())
            );
        }

        return null;
    }

    private function buildComparison(): callable
    {
        return function (Filter $filter): Comparison {
            $field = $filter->field()->value();
            $value = $filter->value()->value();

            return new Comparison($field, $filter->operator()->value(), $value);
        };
    }

    private function formatOrder(Criteria $criteria): ?array
    {
        if (!$criteria->hasOrder()) {
            return null;
        }

        return [$criteria->order()->orderBy()->value() => $criteria->order()->orderType()->value()];
    }
}
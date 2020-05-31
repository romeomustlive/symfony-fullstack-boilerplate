<?php

declare(strict_types=1);


namespace App\Infrastructure\Filters;


use Illuminate\Http\Request;

abstract class AbstractFilters
{
    protected Request $request;

    protected array $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter($qs)
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($qs, $value);
        }

        return $qs;
    }

    protected function resolveFilter(string $filter): Filter
    {
        return resolve($this->filters[$filter]);
    }

    protected function getFilters(): array
    {
        return $this->filterFilters();
    }

    protected function filterFilters(): array
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }
}

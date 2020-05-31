<?php


namespace App\Infrastructure\Filters;


interface Filter
{
    public function filter($qs, $value);
}

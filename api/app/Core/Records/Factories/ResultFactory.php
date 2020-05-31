<?php

declare(strict_types=1);


namespace App\Core\Records\Factories;


use App\Core\Records\Models\Result;

final class ResultFactory
{
    public function create(?float $weight, ?int $quantity): Result
    {
        return new Result([
            'weight' => $weight,
            'quantity' => $quantity
        ]);
    }
}

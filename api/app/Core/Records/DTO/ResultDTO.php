<?php

declare(strict_types=1);


namespace App\Core\Records\DTO;


use Spatie\DataTransferObject\DataTransferObject;

final class ResultDTO extends DataTransferObject
{
    public ?float $weight;

    public ?int $quantity;

    public ?int $exercise_id;
}

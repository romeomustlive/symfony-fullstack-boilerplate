<?php

declare(strict_types=1);


namespace App\Core\Auth\DTO;


use Spatie\DataTransferObject\DataTransferObject;

final class CreateSuperUserDTO extends DataTransferObject
{
    public ?string $name;

    public ?string $email;

    public ?string $password;
}

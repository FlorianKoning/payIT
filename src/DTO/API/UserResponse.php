<?php
declare(strict_types=1);

namespace App\DTO\API;

readonly class UserResponse
{
    public function __construct(
        public string $email,
    ){}
}

<?php
declare(strict_types=1);

namespace App\DTO\API;

use DateTime;
use DateTimeImmutable;

readonly class RegisterResponse
{
    public function __construct(
        public string $token,
        public DateTime $expiresAt,
        public ?DateTimeImmutable $lastUsedAt,
        public UserResponse $user
    ) {}
}

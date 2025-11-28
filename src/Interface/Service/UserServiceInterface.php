<?php
declare(strict_types=1);

namespace App\Interface\Service;

use App\Entity\User;
use App\DTO\API\UserResponse;

interface UserServiceInterface
{
    public function create(UserResponse $userDTO): User;
}

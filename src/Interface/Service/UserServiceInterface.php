<?php
declare(strict_types=1);

namespace App\Interface\Service;

use App\Entity\User;
use App\DTO\API\UserRequestResponse;

interface UserServiceInterface
{
    public function create(UserRequestResponse $userDTO): User;
}

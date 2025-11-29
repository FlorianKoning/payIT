<?php
declare(strict_types=1);

namespace App\Interface\Service;

use App\Entity\User;
use App\Entity\ApiToken;
use App\DTO\API\RegisterResponse;

interface ApiTokenServiceInterface
{
    public function create(User $user): ApiToken;
    public function createResponse(ApiToken $apiToken, User $user): RegisterResponse;
}

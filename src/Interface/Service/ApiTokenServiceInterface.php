<?php
declare(strict_types=1);

namespace App\Interface\Service;

use App\Entity\User;
use App\Entity\ApiToken;

interface ApiTokenServiceInterface
{
    public function create(User $user): ApiToken;
}

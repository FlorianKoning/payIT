<?php
declare(strict_types=1);

namespace App\Service;

use DateTime;
use App\Entity\User;
use App\Entity\ApiToken;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Interface\Service\ApiTokenServiceInterface;

class ApiTokenService implements ApiTokenServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    /**
     * Creates a new apiToken in the database based on the given user.
     *
     * @param User $user
     * @return ApiToken
     */
    public function create(User $user): ApiToken
    {
        $token = new ApiToken();
        $token->setUserId($user);
        $token->setExpiresAt((new DateTime())->modify('+1 year'));

        // Safes the new apiToken
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $token;
    }
}

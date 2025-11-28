<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\DTO\API\UserResponse;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Interface\Service\UserServiceInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserSerivce implements UserServiceInterface
{
    private EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly DTOValidator $DTOValidator,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    public function create(UserResponse $userDTO): User
    {
        // Validates the create DTO.
        $this->DTOValidator->validate($userDTO);

        // Sets up the new user
        $user = new User();
        $user->setEmail($userDTO->email);
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $userDTO->password));

        // Safes the new user
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}

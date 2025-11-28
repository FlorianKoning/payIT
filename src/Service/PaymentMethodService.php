<?php
declare(strict_types=1);

namespace App\Service;

use App\DTO\API\PaymentMethodResponse;
use App\DTO\API\PaymentMethodSearch;
use App\Entity\PaymentMethod;
use App\Exception\PaymentMethodNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Interface\Service\PaymentMethodServiceInterface;

class PaymentMethodService implements PaymentMethodServiceInterface
{
    private EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly DTOValidator $DTOValidator,
    ) {
        $this->repository = $this->entityManager->getRepository(PaymentMethod::class);
    }
}

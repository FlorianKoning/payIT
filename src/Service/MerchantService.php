<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Merchant;
use App\DTO\API\MerchantResponse;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Exception\MerchantNotFoundException;
use App\Interface\Service\MerchantServiceInterface;

class MerchantService implements MerchantServiceInterface
{
    private EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly DTOValidator $DTOValidator,
    ){
        $this->repository = $this->entityManager->getRepository(Merchant::class);
    }

    /**
     * Searches the database for the merchant with the correct public key.
     *
     * @param string $publicId
     * @throws \App\Exception\MerchantNotFoundException
     * @return MerchantResponse
     */
    public function getByPublicId(string $publicId): MerchantResponse
    {
        $merchant = $this->repository->findOneBy(['publicId' => $publicId])
            ?? throw new MerchantNotFoundException();

        return new MerchantResponse(
            name: $merchant->getName(),
            address: $merchant->getAddress(),
            city: $merchant->getCity(),
            state: $merchant->getState(),
            zip: $merchant->getZip(),
            phone_number: $merchant->getPhoneNumber()
        );
    }

    /**
     * Creates a new merchant based on the given content array.
     *
     * @param \App\DTO\API\MerchantResponse $createDTO
     * @return void
     */
    public function create(MerchantResponse $createDTO): MerchantResponse
    {
        // Validates the create DTO.
        $this->DTOValidator->validate($createDTO);

        // Creates the new merchant
        $merchant = new Merchant();
        $merchant->setName($createDTO->name);
        $merchant->setAddress($createDTO->address);
        $merchant->setCity($createDTO->city);
        $merchant->setState($createDTO->state);
        $merchant->setZip($createDTO->zip);
        $merchant->setPhoneNumber($createDTO->phone_number);

        // Safes the new merchant
        $this->entityManager->persist($merchant);
        $this->entityManager->flush();

        return new MerchantResponse(
            name: $merchant->getName(),
            address: $merchant->getAddress(),
            city: $merchant->getCity(),
            state: $merchant->getState(),
            zip: $merchant->getZip(),
            phone_number: $merchant->getPhoneNumber()
        );
    }
}

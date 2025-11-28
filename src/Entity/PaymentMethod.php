<?php

namespace App\Entity;

use App\Enum\PaymentMethodBrands;
use App\Repository\PaymentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentMethodRepository::class)]
class PaymentMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: PaymentMethodBrands::class)]
    private ?PaymentMethodBrands $brands = null;

    #[ORM\Column(length: 36)]
    private ?string $publicId = null;

    #[ORM\Column(length: 36)]
    private ?string $merchantId = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrands(): ?PaymentMethodBrands
    {
        return $this->brands;
    }

    public function setBrands(PaymentMethodBrands $brands): static
    {
        $this->brands = $brands;

        return $this;
    }

    public function getPublicId(): ?string
    {
        return $this->publicId;
    }

    public function setPublicId(string $publicId): static
    {
        $this->publicId = $publicId;

        return $this;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): static
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

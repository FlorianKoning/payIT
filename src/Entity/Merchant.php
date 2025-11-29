<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\MerchantRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MerchantRepository::class)]
class Merchant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['merchant:read'])]
    #[ORM\Column(length: 128)]
    private ?string $name = null;

    #[Groups(['merchant:read'])]
    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[Groups(['merchant:read'])]
    #[ORM\Column(length: 128)]
    private ?string $city = null;

    #[Groups(['merchant:read'])]
    #[ORM\Column(length: 128)]
    private ?string $state = null;

    #[Groups(['merchant:read'])]
    #[ORM\Column(length: 128)]
    private ?string $zip = null;

    #[Groups(['merchant:read'])]
    #[ORM\Column(length: 20)]
    private ?string $phone_number = null;

    #[ORM\Column(length: 32)]
    private ?string $SecretSalt = null;

    #[ORM\Column(length: 191)]
    private ?string $publicId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getSecretSalt(): ?string
    {
        return $this->SecretSalt;
    }

    public function setSecretSalt(string $SecretSalt): static
    {
        $this->SecretSalt = $SecretSalt;

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
}

<?php
declare(strict_types=1);

namespace App\DTO\API;

use Symfony\Component\Validator\Constraints as Assert;

class MerchantResponse
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 50)]
        public readonly string $name,

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 50)]
        public readonly string $address,

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 20)]
        public readonly string $city,

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 50)]
        public readonly string $state,

        #[Assert\NotBlank]
        #[Assert\Length(min: 5, max: 7)]
        public readonly string $zip,
         #[Assert\NotBlank]
        #[Assert\Length(min: 9, max: 20)]
        public readonly string $phone_number,
    ){}
}

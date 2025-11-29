<?php
declare(strict_types=1);

namespace App\DTO\API;

use Symfony\Component\Validator\Constraints as Assert;

class UserRequestResponse
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 50)]
        #[Assert\Email(
            message: 'The email {{ value }} is not a valid email.',
        )]
        public readonly string $email,

        #[Assert\NotBlank]
        #[Assert\Length(min: 8, max: 50)]
        #[Assert\Type('string')]
        public readonly string $password,
    ){}
}

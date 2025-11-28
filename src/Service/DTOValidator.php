<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class DTOValidator
{
    public function __construct(
        private readonly ValidatorInterface $validator
    ){}

    /**
     * Validates if the given content has any violations.
     *
     * @param object $content
     * @throws \App\Exception\ValidationFailedException
     * @return void
     */
    public function validate(object $content): void
    {
        $violations = $this->validator->validate($content);

        if (count($violations) > 0) {
            throw new ValidationFailedException($content, $violations);
        }
    }
}

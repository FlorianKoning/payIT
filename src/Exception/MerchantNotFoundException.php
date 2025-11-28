<?php
declare(strict_types=1);

namespace App\Exception;

use DomainException;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MerchantNotFoundException extends NotFoundHttpException
{
    public function __construct(string $message = 'Merchant not found', ?Exception $previous = null)
    {
        parent::__construct($message, $previous, 404);
    }
}

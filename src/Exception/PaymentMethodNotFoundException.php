<?php
declare(strict_types=1);

namespace App\Exception;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentMethodNotFoundException extends NotFoundHttpException
{
    public function __construct(string $message = 'Payment method not found./', ?Exception $previous = null)
    {
        parent::__construct($message, $previous, 404);
    }
}

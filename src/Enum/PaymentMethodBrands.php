<?php
declare(strict_types=1);

namespace App\Enum;

enum PaymentMethodBrands: string
{
    case VISA = 'visa';
    case MASTERCARD = 'mastercard';
    case IDEAL = 'ideal';
    case PAYPAL = 'paypal';
    case KLARNA = 'klarna';
}

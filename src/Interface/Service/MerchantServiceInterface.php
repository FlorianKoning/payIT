<?php
declare(strict_types=1);

namespace App\Interface\Service;

use App\DTO\API\MerchantResponse;

interface MerchantServiceInterface
{
    public function getByPublicId(string $publicId): MerchantResponse;
    public function create(MerchantResponse $merchant): MerchantResponse;
}

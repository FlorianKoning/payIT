<?php

namespace App\DataFixtures;

use App\Entity\Merchant;
use App\Entity\PaymentMethod;
use App\Enum\PaymentMethodBrands;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Hashids\Hashids;
use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Creates a boiler merchant
        $merchant = new Merchant();
        $merchant->setName("Alberhein");
        $merchant->setAddress('Hadrianuslaan 15');
        $merchant->setCity("Den Hoorn");
        $merchant->setState("Zuid-Holland");
        $merchant->setZip("2635BV");
        $merchant->setPhoneNumber("0628424913");
        $merchant->setPublicId(Uuid::v4()->toString());
        $merchant->setSecretSalt(bin2hex(random_bytes(16)));
        $manager->persist($merchant);

        // Creates a boiler payment method.
        $paymentMethod = new PaymentMethod();
        $paymentMethod->setBrands(PaymentMethodBrands::IDEAL);

        // Generates the hashed publicId.
        $hashId = new Hashids($merchant->getSecretSalt(), 9);
        $paymentMethod->setPublicId('pm_' . $hashId->encode(1));

        $paymentMethod->setMerchantId($merchant->getPublicId());
        $manager->persist($paymentMethod);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $address = new Address();
            $address->setNumber(10)->setStreet('test');
            $user->setName('User-'. $i)->setAddress($address);
            $manager->persist($user);
        }
        $manager->flush();
    }
}

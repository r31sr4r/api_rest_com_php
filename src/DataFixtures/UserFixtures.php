<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user
            ->setUsername('usrpromobit')
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$VpwI9fFbEnwg7HFz6scy6Q$CziZY/YDzTDiKaNpO6oi8C4uDwDyX8M3GyGcO3EqMCY');

        $manager->persist($user);
        $manager->flush();
    }
}

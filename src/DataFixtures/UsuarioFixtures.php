<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsuarioFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new Usuario();
        $user
            ->setNome('Promobit Desafio')
            ->setUsername('usrpromobit')
            ->setCpf('000.000.000-00')
            ->setEmail('desafio@promobit.com.br')
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$VpwI9fFbEnwg7HFz6scy6Q$CziZY/YDzTDiKaNpO6oi8C4uDwDyX8M3GyGcO3EqMCY');

        $manager->persist($user);
        $manager->flush();
    }
}
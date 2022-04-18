<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName("Café pur Arabica");
        $product1->setPrice("19.5");
        $product1->setStock(true);
        $product1->setCreatedAt(new \DateTimeImmutable());
        $product1->setPicture("https://bit.ly/3Kpsm1M");
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName("Café en Grain Aromatisé");
        $product2->setPrice("18.5");
        $product2->setStock(true);
        $product2->setCreatedAt(new \DateTimeImmutable());
        $product2->setPicture("https://bit.ly/35Tw9Fz");
        $manager->persist($product2);

        $manager->flush();
    }
}

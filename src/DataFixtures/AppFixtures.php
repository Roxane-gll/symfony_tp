<?php

namespace App\DataFixtures;

use App\Entity\Link;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i<1000; $i++){
            $link = new Link();
            $link->setTitle("A link fixtured")
                ->setUrl("http://google.com")
                ->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($link);
        }

        $manager->flush();
    }
}
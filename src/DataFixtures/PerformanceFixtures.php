<?php

namespace App\DataFixtures;

use App\Entity\Performance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PerformanceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 6; $i++) {
         $performance = new Performance();
         $performance->setTitle($faker->text(5));
         $performance->setDescription($faker->text(100));
         $performance->setImage('https://i.imgur.com/oCkEbrA.png');
         $manager->persist($performance);

        $manager->flush();
    }
    }
}

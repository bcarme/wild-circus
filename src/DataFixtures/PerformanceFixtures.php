<?php

namespace App\DataFixtures;

use App\Entity\Performance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PerformanceFixtures extends Fixture
{
    const NAMES = ['Disco Logic', 'JuggleMatic', 'Marvel At', 'Abduction Sonore', 'Circus 101', 'Quatuor for a Dream'
    ];

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();

        $i=0;
        foreach (self::NAMES as $name){
         $performance = new Performance();
         $performance->setTitle($name);
         $performance->setDescription($faker->text(100));
         $performance->setImage('https://i.imgur.com/oCkEbrA.png');
         $manager->persist($performance);

        $manager->flush();
        }
    }
}

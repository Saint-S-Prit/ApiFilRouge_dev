<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupTag;
use App\Repository\TagRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupeTagFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 3; $i++) {
            $grpoue . $i = new GroupTag();

            $manager->persist($admin);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProfileFixtures::class,
        );
    }
}

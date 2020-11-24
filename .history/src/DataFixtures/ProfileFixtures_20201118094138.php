<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class ProfileFixtures extends Fixture
{
    public const PROFILE_USER = "user";



    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 5; $i++) {
            $profile = new Profile();
            $profile->getLibelle($faker->unique()->randomElement(['ADMIN', 'TEACHER', 'LEARNER', 'CM']));
            $this->addReference(self::PROFILE_USER . $i, $profile);
            $manager->persist($profile);
        }

        $manager->flush();
    }
}

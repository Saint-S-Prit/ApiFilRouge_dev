<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\Validator\Constraints\Unique;

class ProfileFixtures extends Fixture
{
    public const PROFILE_USER = "user";



    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $arayProfiles = ['ADMIN', 'TEACHER', 'LEARNER', 'CM'];

        for ($i = 0; $i < count($arayProfiles); $i++) {
            $profile = new Profile();
            $profile->setLibelle($faker->unique()->$arayProfiles[$i]);
            $this->addReference(self::PROFILE_USER . $i, $profile);
            $manager->persist($profile);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $arrayProfiles = ['ADMIN', 'TEACHER', 'LEARNER', 'CM'];


        foreach ($arrayProfiles as $arrayProfile) {
            $profile = new Profile();
            $profile
                ->setLibelle($arrayProfile);
            $manager->persist($profile);
            $manager->flush();
            $this->addReference($arrayProfile, $profile);
        }
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfileFixtures extends Fixture
{
    public const PROFILE_USER = "user";



    public function load(ObjectManager $manager)
    {
        $arayProfiles = ['ADMIN', 'TEACHER', 'LEARNER', 'CM'];

        for ($o = 0; $o < count($arayProfiles); $o++) {
            $profile = new Profile();
            $profile
                ->setLibelle($arayProfiles[$o]);
            $this->addReference(self::PROFILE_USER . $arayProfiles[$o], $profile);
            $manager->persist($profile);
        }

        $manager->flush();
    }
}

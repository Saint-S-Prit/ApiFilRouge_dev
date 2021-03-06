<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfileFixtures extends Fixture
{
    public const ADMINISTRATOR_REFERENCE = 'ADMINISTRATOR';
    public const TEACHER_REFERENCE = 'TEACHER';
    public const LEARNER_REFERENCE = 'LEARNER';
    public const CM_REFERENCE = 'CM';


    public function load(ObjectManager $manager)
    {
        $arrayProfile = ['ADMINISTRATOR_REFERENCE', 'TEACHER_REFERENCE', 'LEARNER_REFERENCE', 'CM'];

        $admin = new Profile();
        $admin
            ->setLibelle(self::ADMINISTRATOR_REFERENCE);
        $manager->persist($admin);
        $this->addReference(self::ADMINISTRATOR_REFERENCE, $admin);


        $teacher = new Profile();
        $teacher
            ->setLibelle(self::TEACHER_REFERENCE);
        $manager->persist($teacher);
        $this->addReference(self::TEACHER_REFERENCE, $teacher);


        $learner = new Profile();
        $learner
            ->setLibelle(self::LEARNER_REFERENCE);
        $manager->persist($learner);
        $this->addReference(self::LEARNER_REFERENCE, $learner);


        $cm = new Profile();
        $cm
            ->setLibelle(self::CM_REFERENCE);
        $manager->persist($cm);
        $this->addReference(self::CM_REFERENCE, $cm);

        $manager->flush();
    }
}

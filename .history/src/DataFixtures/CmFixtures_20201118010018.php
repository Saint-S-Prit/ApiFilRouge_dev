<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CmFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $cm = new Cm();

            $hash = $this->encoder->encodePassword($cm, "password");
            //$avatar = fopen($faker->imageUrl($width = 300, $height = 300), "rb");
            $cm
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setEmail($faker->email)
                ->setIsDeleted(false)
                ->setPassword($hash)
                ->setProfile($this->getReference(ProfileFixtures::CM_REFERENCE));

            $manager->persist($cm);
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

<?php

namespace App\DataFixtures;

use App\Entity\Cm;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
                ->setPassword($hash)
                ->setAdresse($faker->city)
                ->setIsDeleted(false)
                ->setGender($faker->randomElement(["male", "female"]))
                ->setPhone($faker->unique()->randomElement(["778097818", "775322611", "773030259"]))
                ->setProfile($this->getReference(ProfileFixtures::PROFILE_USER));

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

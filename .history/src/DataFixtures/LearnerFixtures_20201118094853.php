<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Learner;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LearnerFixtures extends Fixture  implements DependentFixtureInterface
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

            $learner = new Learner();

            $hash = $this->encoder->encodePassword($learner, "password");
            //$avatar = fopen($faker->imageUrl($width = 300, $height = 300), "rb");
            $learner
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setEmail($faker->email)
                ->setPassword($hash)
                ->setAdresse($faker->city)
                ->setPhone($faker->phoneNumber)
                ->setGender($faker->randomElement(["male", "female"]))
                ->setStatus($faker->randomElement(["deaded", "abandoned", "sick", "suspended"]))
                ->setProfile($this->getReference(ProfileFixtures::PROFILE_USER . $i));

            $manager->persist($learner);
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

<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Admin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TeacherFixtures extends Fixture  implements DependentFixtureInterface
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

            $teacher = new Teacher();

            $hash = $this->encoder->encodePassword($teacher, "password");
            //$avatar = fopen($faker->imageUrl($width = 300, $height = 300), "rb");
            $teacher
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setEmail($faker->email)
                ->setIsDeleted(false)
                ->setPassword($hash)
                ->setProfile($this->getReference(ProfileFixtures::TEACHER_REFERENCE));

            $manager->persist($teacher);
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

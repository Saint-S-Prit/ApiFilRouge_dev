<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupTag;
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

            $hash = $this->encoder->encodePassword($admin, "password");
            //$avatar = fopen($faker->imageUrl($width = 300, $height = 300), "rb");
            $admin
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setEmail($faker->email)
                ->setPassword($hash)
                ->setIsDeleted(false)
                ->setAdresse($faker->city)
                ->setGender($faker->randomElement(["male", "female"]))
                ->setPhone($faker->unique()->randomElement(["778097818", "775322611", "773030259"]))
                ->setProfile($this->getReference("ADMIN"));

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

<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $collectionTags = ['symfony', 'laravel', 'mysql', 'firebase', 'php'];
        foreach ($collectionTags as $collectionTag) {
            $tag = new Tag();
            $tag
                ->setLibelle($collectionTag)
                ->setDescription($faker->sentence(6, true));
            $manager->persist($tag);
            $manager->flush();

            $this->addReference($arrayProfile, $profile);
        }
    }
}

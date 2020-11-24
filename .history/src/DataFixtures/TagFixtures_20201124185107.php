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

        $collectionTags = [
            ['symfony', "some text describ this libelle"],
            ['laravel', "another text describ this libelle"],
            ['mysql', "mysql text describ this libelle"],
            ['firebase', "firebose some text describ this libelle"],
            ['php', "php some text describ this libelle"]
        ];
        foreach ($collectionTags as $collectionTag) {
            $tag = new Tag();
            $tag
                ->setLibelle($collectionTags)
                ->setDescription($faker->sentence(6, true));
            $manager->persist($tag);
            $manager->flush();
            $this->addReference($collectionTag, $tag);
        }
    }
}

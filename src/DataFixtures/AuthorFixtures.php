<?php

namespace App\DataFixtures;

use App\Entity\Author;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100; $i++) { 
            $author = new Author();
            $author->setFirstname($faker->firstName())
                    ->setLastname($faker->lastName())
                    ->setDateOfBirth($faker->dateTimeBetween('-60 years', '-18 years'))
                    ->setNationality($faker->country())
            ;

            $manager->persist($author);

            $this->setReference('author_' . $i, $author);
        }
        
        $manager->flush();
    }
}

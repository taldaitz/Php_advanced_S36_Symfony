<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 300; $i++) { 
            $book = new Book();
            $book->setTitle($faker->sentence(3))
                ->setDescription($faker->paragraph())
                ->setPublishedDate($faker->dateTimeInInterval())
                ->setAuthor($this->getReference('author_' . rand(0, 99)))
            ;

            $manager->persist($book);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixtures::class,
        ];
    }
}

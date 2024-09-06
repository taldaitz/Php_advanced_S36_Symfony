<?php

namespace App\Tests;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookPagesTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/books');

        $this->assertResponseIsSuccessful(); // Smoke Test -> Vérifie que le code retour est bien 200
        $this->assertSelectorTextContains('#cat', 'Mes livres');

        $secondH1 = $crawler->filter('h1')->eq(1)->text();
        $this->assertEquals('Test H1', $secondH1);


        $container = self::getContainer();

        $bookRepository = $container->get(BookRepository::class);
        $book = $bookRepository->findOneBy(['title' => 'Le seigneur des anneaux']);

        $book->getId();
    }
}

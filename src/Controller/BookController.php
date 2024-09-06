<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/books', name: 'app_book')]
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAllWithAuthor();

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }


    #[Route('/books/create', name: 'app_book_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_book');
        }

        return $this->render('book/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/books/{id}', name: 'app_book_show')]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

}

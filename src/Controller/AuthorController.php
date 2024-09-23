<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showAuthor/{name}', name: 'app_showAuthor')]
    public function showAuthor($name): Response
    {

        return $this->render('author/showAuthor.html.twig', ['name' => $name]);
    }

    #[Route('/listAuthors', name: 'app_listAuthors')]
    public function listAuthors(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha-Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );

        if (!isset($authors) || empty($authors)) {
            $authors = [];
        }


        $totalBooks = array_sum(array_column($authors, 'nb_books'));

        return $this->render('author/list.html.twig', [
            'authors' => $authors,
            'totalBooks' => $totalBooks,
        ]);
    }
    #[Route('/author/{id}', name: 'app_author_details')]
    public function authorDetails($id): Response
    {

        $authors = [
            1 => ['id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100],
            2 => ['id' => 2, 'picture' => '/images/william.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200],
            3 => ['id' => 3, 'picture' => '/images/Taha-Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300],
        ];


        if (!isset($authors[$id])) {
            throw $this->createNotFoundException('Author not found');
        }

        $author = $authors[$id];

        return $this->render('author/details.html.twig', [
            'author' => $author,
        ]);
    }
}

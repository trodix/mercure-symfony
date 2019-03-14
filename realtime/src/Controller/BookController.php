<?php

namespace App\Controller;

use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Book;

class BookController extends AbstractController
{

    /**
     * @Route(path="/", methods={"GET"} , name="index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('App:Front:index.html.twig', []);
    }

    /**
     * @Route(path="/books/{id}", methods={"GET", "POST"} , name="book")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function books(MessageBusInterface $bus, int $id) {
        
        $book1 = new Book(1, "book-1", "Non disponible");
        $book2 = new Book(2, "book-2", "En stock");
        $book3 = new Book(3, "book-3", "En stock");
        $book4 = new Book(4, "book-4", "En stock");
        $book5 = new Book(5, "book-5", "Non disponible");
        $book6 = new Book(6, "book-6", "En stock");

        $bibliotheque = [
            $book1,
            $book2,
            $book3,
            $book4,
            $book5,
            $book6
        ];

        foreach ($bibliotheque as $book) {
            if($book->id == $id) {
                $update = new Update(
                    "http://localhost:8000/books/{$book->name}",
                    json_encode(['id' => $book->id, 'status' => $book->status])
                );
        
                $bus->dispatch($update);
                return new Response('published!');
            }
        }

        throw $this->createNotFoundException("The book of id {$id} does not exists.");  
        
    }
}
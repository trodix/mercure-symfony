<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Repository\BookRepository;
use Symfony\Component\Mercure\Update;
use App\Service\MercureCookieGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BookController extends AbstractController
{

    /**
     * @Route(path="/", methods={"GET", "POST"} , name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request) {
        return $this->render('home/index.html.twig', []);
    }


    /**
     * @Route(path="/book", methods={"GET", "POST"} , name="index_book")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function book(MercureCookieGenerator $cookieGenerator) {
        $response = $this->render('book/index.html.twig', []);
        $response->headers->set('set-cookie', $cookieGenerator->generate($this->getUser()));
        return $response;
    }

    /**
     * @Route(path="/books/{user_id}/{book_id}", methods={"GET", "POST"} , name="book")
     * @ParamConverter("user", options={"id" = "user_id"})
     * @ParamConverter("book", options={"id" = "book_id"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function books(MessageBusInterface $bus, BookRepository $repository, User $user, Book $book) {

        $targets = [];
        if($user !== null) {
            $targets = [
                //"http://localhost:8000/user/{$user->getId()}"
            ];
        }

        $bibliotheque = $repository->findAll();

        foreach ($bibliotheque as $b) {
            if($book->id == $b->id) {
                $update = new Update(
                    "http://localhost:8000/books/{$b->name}",
                    json_encode(['id' => $b->id, 'status' => $b->status]),
                    $targets
                );
        
                $bus->dispatch($update);
                return new Response('published!', 200);
            }
        }

        throw $this->createNotFoundException("The book of id {$book->id} does not exists.");  
        
    }
}
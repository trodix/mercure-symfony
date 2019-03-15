<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $book1 = new Book("book-1", "Non disponible");
        $book2 = new Book("book-2", "En stock");
        $book3 = new Book("book-3", "En stock");
        $book4 = new Book("book-4", "En stock");
        $book5 = new Book("book-5", "Non disponible");
        $book6 = new Book("book-6", "En stock");

        $manager->persist($book1);
        $manager->persist($book2);
        $manager->persist($book3);
        $manager->persist($book4);
        $manager->persist($book5);
        $manager->persist($book6);

        $manager->flush();
    }
}

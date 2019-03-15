<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = (new User())
            ->setEmail("user1@test.com")
            ->setRoles(["ROLE_ADMIN"]);
        $user1->setPassword(
            $this->passwordEncoder->encodePassword($user1, 'password')
        );

        $manager->persist($user1);

        $user2 = (new User())
            ->setEmail("user2@test.com")
            ->setRoles(["ROLE_USER"]);
        $user2->setPassword(
            $this->passwordEncoder->encodePassword($user2, 'password')
        );

        $manager->persist($user2);


        $manager->flush();
    }
}

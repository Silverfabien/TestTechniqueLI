<?php

namespace App\DataFixtures;

use App\Entity\Security\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAdminFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // Create user admin
        $user = new User();
        $user->setFirstname('Prénom');
        $user->setLastname('Nom');
        $user->setEmail('admin@gmail.com');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "admin12345"));
        $user->setGender(0);
        $user->setCountry("France");
        $user->setRegion("Hauts de France");
        $user->setJob("Un metier");
        $user->setBirthday(new \DateTimeImmutable('1970/01/01'));
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($user);
        $manager->flush();
    }
}

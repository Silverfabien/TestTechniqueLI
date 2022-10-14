<?php

namespace App\DataFixtures;

use App\Entity\Security\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $geolocationData = [
            [
                "country" => "Chine",
                "regionName" => "Province de Guangdong"
            ],
            [
                "country" => "États-Unis",
                "regionName" => "Ohio"
            ],
            [
                "country" => "États Unis",
                "regionName" => "Géorgie"
            ],
            [
                "country" => "États Unis",
                "regionName" => "Massachusetts"
            ],
            [
                "country" => "France",
                "regionName" => "Île-de-France"
            ],
            [
                "country" => "Italie",
                "regionName" => "Lombardie"
            ],
            [
                "country" => "Canada",
                "regionName" => "Ontario"
            ],
            [
                "country" => "Égypte",
                "regionName" => "Alexandria"
            ],
            [
                "country" => "Allemagne",
                "regionName" => "Bavière"
            ],
            [
                "country" => "Pays-Bas",
                "regionName" => "Utrecht"
            ],
            [
                "country" => "Corée du Sud",
                "regionName" => "Daegu"
            ],
            [
                "country" => "Espagne",
                "regionName" => "Aragon"
            ],
            [
                "country" => "Canada",
                "regionName" => "Ontario"
            ],
            [
                "country" => "Turquie",
                "regionName" => "Istanbul"
            ]
        ];

        $jobData = [
            "Accompagnant", "Médecin", "Coach sportif", "Électricien", "Plombier", "Technicien", "Mécanicien",
            "Professeur", "Boulanger", "Boucher", "Pâtissier", "Développeur", "Chirurgien", "Vétérinaire"
        ];

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i<200; $i++) {
            $geolocation = $geolocationData[random_int(0, count($geolocationData) - 1)];

            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $faker->password));
            $user->setGender($faker->boolean());

            $user->setCountry($geolocation["country"]);
            $user->setRegion($geolocation["regionName"]);
            $user->setJob($jobData[random_int(0, count($jobData) - 1)]);
            $user->setBirthday($faker->dateTimeBetween('-100 year'));

            $manager->persist($user);
        }

        $manager->flush();
    }
}

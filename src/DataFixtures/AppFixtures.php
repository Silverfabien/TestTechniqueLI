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
        $jobData = [
            "Accompagnant", "Médecin", "Coach sportif", "Électricien", "Plombier", "Technicien", "Mécanicien",
            "Professeur", "Boulanger", "Boucher", "Pâtissier", "Développeur", "Chirurgien", "Vétérinaire"
        ];

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i<300; $i++) {
            $ip = $faker->ipv4;
            $ipApi = file_get_contents("http://ip-api.com/json/".$ip."?fields=9&lang=fr");
            $decodeApi = json_decode($ipApi, true);

            // If API return null
            if (!$decodeApi) {
                $i--;
            }

            if ($decodeApi) {
                $user = new User();
                $user->setFirstname($faker->firstName);
                $user->setLastname($faker->lastName);
                $user->setEmail($faker->email);
                $user->setPassword($this->userPasswordHasher->hashPassword($user, $faker->password));
                $user->setGender($faker->boolean());

                $user->setCountry($decodeApi["country"]);
                $user->setRegion($decodeApi["regionName"]);
                $user->setJob($jobData[random_int(0, count($jobData) - 1)]);
                $user->setBirthday($faker->dateTimeBetween('-100 year'));

                $manager->persist($user);
            }

            // Max 45 request per minute
            sleep(2);
        }

        $manager->flush();
    }
}

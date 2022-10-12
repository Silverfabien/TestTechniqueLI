<?php

namespace App\ControllerHandler\Security;

use App\Entity\Security\User;
use App\Repository\Security\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationHandler
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $userPasswordHasher;
    private SessionInterface $session;

    /**
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param SessionInterface $session
     */
    public function __construct(
        UserRepository $userRepository,
        UserPasswordHasherInterface $userPasswordHasher,
        SessionInterface $session
    )
    {
        $this->userRepository = $userRepository;
        $this->userPasswordHasher = $userPasswordHasher;
        $this->session = $session;
    }

    public function registerHandle(
        FormInterface $form,
        User $user
    ): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $info = $this->session->get("localisation");

            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setCountry($info["country"]);
            if ($info["regionName"]) {
                $user->setRegion($info["regionName"]);
            }

            $this->userRepository->save($user, true);

            return true;
        }

        return false;
    }
}

<?php

namespace App\ControllerHandler\Administration;

use App\Entity\Security\User;
use App\Repository\Administration\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserHandler
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userRepository = $userRepository;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     */
    public function createUserHandle(
        FormInterface $form,
        User $user
    ): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $this->userRepository->save($user, true);

            return true;
        }

        return false;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     */
    public function updateUserHandle(
        FormInterface $form
    ): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $this->userRepository->update(true);

            return true;
        }

        return false;
    }

    public function updateUserPasswordHandle(
        FormInterface $form,
        User $user
    ): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $this->userRepository->update(true);

            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function removeUserHandle(
        User $user
    ): bool
    {
        $this->userRepository->remove($user, true);

        return true;
    }
}

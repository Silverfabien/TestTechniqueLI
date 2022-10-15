<?php

namespace App\Controller\Administration;

use App\Entity\Security\User;
use App\Form\Security\UserType;
use App\Repository\Administration\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class UserController extends AbstractController
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserRepository $userRepository
     * @return Response
     */
    #[Route('/', name: 'app_administration_user_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('administration/user/index.html.twig', [
            'users' => $this->userRepository->findBy([], ["country" => "ASC", "region" => "ASC"]),
        ]);
    }

    #[Route('/new', name: 'app_administration_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userRepository->save($user, true);

            return $this->redirectToRoute('app_administration_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administration/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_administration_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('administration/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_administration_user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        User $user
    ): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userRepository->save($user, true);

            return $this->redirectToRoute('app_administration_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administration/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_administration_user_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        User $user
    ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_administration_user_index', [], Response::HTTP_SEE_OTHER);
    }
}

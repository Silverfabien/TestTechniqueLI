<?php

namespace App\Controller\Administration;

use App\ControllerHandler\Administration\UserHandler;
use App\Entity\Security\User;
use App\Form\Administration\AdminAddUserType;
use App\Form\Administration\AdminEditUserPasswordType;
use App\Form\Administration\AdminEditUserType;
use App\Repository\Administration\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class UserController extends AbstractController
{
    private UserRepository $userRepository;
    private UserHandler $userHandler;
    private MailerInterface $mailer;

    /**
     * @param UserRepository $userRepository
     * @param UserHandler $userHandler
     * @param MailerInterface $mailer
     */
    public function __construct(UserRepository $userRepository, UserHandler $userHandler, MailerInterface $mailer)
    {
        $this->userRepository = $userRepository;
        $this->userHandler = $userHandler;
        $this->mailer = $mailer;
    }

    /**
     * @param UserRepository $userRepository
     * @return Response
     */
    #[Route('/', name: 'admin_user_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('administration/user/index.html.twig', [
            'users' => $this->userRepository->findBy(
                [],
                [
                    "country" => "ASC",
                    "region" => "ASC"
                ]
            )
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    #[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(AdminAddUserType::class, $user)->handleRequest($request);

        if ($this->userHandler->createUserHandle($form, $user)) {
            $emailForUser = $this->sendEmailForUser($user);
            $this->mailer->send($emailForUser);

            $emailForAdmin = $this->sendEmailForAdmin($user);
            $this->mailer->send($emailForAdmin);

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administration/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @param User $user
     * @return Response
     */
    #[Route('/{id}', name: 'admin_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('administration/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        User $user
    ): Response
    {
        $form = $this->createForm(AdminEditUserType::class, $user)->handleRequest($request);

        if ($this->userHandler->updateUserHandle($form)) {
            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administration/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    #[Route('/{id}/edit_password', name: 'admin_user_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(
        Request $request,
        User $user
    ): Response
    {
        $form = $this->createForm(AdminEditUserPasswordType::class, $user)->handleRequest($request);

        if ($this->userHandler->updateUserPasswordHandle($form, $user)) {
            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administration/user/editPassword.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    #[Route('/{id}', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        User $user
    ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->userHandler->removeUserHandle($user);
        }

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/email_user', name: 'admin_email_user')]
    public function sendEmailForUser(
        User $user
    ): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from('testtechnique@gmail.com')
            ->to($user->getEmail())
            ->subject('Récapitulatif de l\'inscription faîtes par un administrateur du site')
            ->htmlTemplate('administration\user\_emailForUser.html.twig')
            ->context(['user' => $user])
            ;
    }

    #[Route('/email_admin', name: 'admin_email_admin')]
    public function sendEmailForAdmin(
        User $user
    ): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from('testtechnique@gmail.com')
            ->to('hollebeque.fabien@hotmail.com')
            ->subject(
                'Récapitulatif de l\'inscription de '
                .$user->getLastname()
                .' '
                .$user->getFirstname()
                .' faîtes par un administrateur du site'
            )
            ->htmlTemplate('administration\user\_emailForAdmin.html.twig')
            ->context(['user' => $user])
            ;
    }
}

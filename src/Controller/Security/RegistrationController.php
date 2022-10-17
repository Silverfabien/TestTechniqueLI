<?php

namespace App\Controller\Security;

use App\ControllerHandler\Security\RegistrationHandler;
use App\Entity\Security\User;
use App\Form\Security\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    private RegistrationHandler $registrationHandler;
    private MailerInterface $mailer;

    /**
     * @param RegistrationHandler $registrationHandler
     * @param MailerInterface $mailer
     */
    public function __construct(
        RegistrationHandler $registrationHandler,
        MailerInterface $mailer
    ) {
        $this->registrationHandler = $registrationHandler;
        $this->mailer = $mailer;
    }


    #[Route('/register', name: 'register')]
    public function register(
        Request $request,
        UserAuthenticatorInterface $userAuthenticator,
        LoginFormAuthenticator $loginFormAuthenticator
    ): Response|TemplatedEmail
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('default');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user)->handleRequest($request);

        if ($this->registrationHandler->registerHandle($form, $user)) {
            $emailForUser = $this->sendEmailForUser($user);
            $this->mailer->send($emailForUser);

            $emailForAdmin = $this->sendEmailForAdmin($user);
            $this->mailer->send($emailForAdmin);

            return $userAuthenticator->authenticateUser(
                $user,
                $loginFormAuthenticator,
                $request
            );
        }

        return $this->render('security/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/email_user', name: 'email_user')]
    public function sendEmailForUser(
        User $user
    ): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from('testtechnique@gmail.com')
            ->to($user->getEmail())
            ->subject('Récapitulatif de l\'inscription')
            ->htmlTemplate('security\registration\_emailForUser.html.twig')
            ->context(['user' => $user])
        ;
    }

    #[Route('/email_admin', name: 'email_admin')]
    public function sendEmailForAdmin(
        User $user
    ): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from('testtechnique@gmail.com')
            ->to('hollebeque.fabien@hotmail.com')
            ->subject('Récapitulatif de l\'inscription de '.$user->getLastname().' '.$user->getFirstname())
            ->htmlTemplate('security\registration\_emailForAdmin.html.twig')
            ->context(['user' => $user])
        ;
    }
}

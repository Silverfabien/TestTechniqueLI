<?php

namespace App\Controller\Security;

use App\ControllerHandler\Security\RegistrationHandler;
use App\Entity\Security\User;
use App\Form\Security\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    private RegistrationHandler $registrationHandler;

    /**
     * @param RegistrationHandler $registrationHandler
     */
    public function __construct(RegistrationHandler $registrationHandler)
    {
        $this->registrationHandler = $registrationHandler;
    }

    #[Route('/register', name: 'register')]
    public function register(
        Request $request
    ): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user)->handleRequest($request);

        if ($this->registrationHandler->registerHandle($form, $user)) {

            return $this->redirectToRoute('default');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

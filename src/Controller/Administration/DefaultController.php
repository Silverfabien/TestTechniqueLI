<?php

namespace App\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class DefaultController extends AbstractController
{
    #[Route('/', name: 'admin_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('administration/default/index.html.twig');
    }
}

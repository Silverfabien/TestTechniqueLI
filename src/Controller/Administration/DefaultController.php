<?php

namespace App\Controller\Administration;

use App\Repository\Administration\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class DefaultController extends AbstractController
{
    #[Route('/', name: 'admin_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('administration/default/index.html.twig', [
            'nb_user' => count($userRepository->findAll()),
            'nb_user_last_7_day' => $userRepository->userRegisterLastDay()[1],
            'last_user_register' => $userRepository->findOneBy([],['createdAt' => 'DESC']),
            'country_most_user' => $userRepository->countryMostUtilisateur()[0][0]
        ]);
    }

    #[Route('/pie', name: 'admin_index_pie')]
    public function graphPie(
        Request $request,
        UserRepository $userRepository
    ): JsonResponse
    {
        $result = "";

        if ($request->getMethod() === 'GET' && $request->isXmlHttpRequest()) {
            $result = $userRepository->countryMostUtilisateur();

            return new JsonResponse([$result, count($result)]);
        }

        return new JsonResponse($result);
    }

    #[Route('/bar', name: 'admin_index_bar')]
    public function bar(
        Request $request,
        UserRepository $userRepository,
    ): JsonResponse
    {
        $result = "";

        if ($request->getMethod() === 'GET' && $request->isXmlHttpRequest()) {

            $result = $userRepository->userRegisterlastDay()[0];

            return new JsonResponse($result);
        }

        return new JsonResponse($result);
    }
}

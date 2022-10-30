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
    public function index(): Response
    {
        return $this->render('administration/default/index.html.twig');
    }

    #[Route('/pie', name: 'admin_index_pie')]
    public function graphPie(
        Request $request,
        UserRepository $userRepository
    ): JsonResponse
    {
        $result = "";

        if ($request->getMethod() === 'GET' && $request->isXmlHttpRequest()) {
            $users = $userRepository->findAll();

            foreach ($users as &$value) {
                $value = $value->getCountry();
                $values[] = $value;
            }

            $sortValue = array_count_values($values);
            arsort($sortValue);

            $i = 0;
            foreach ($sortValue as $country => $numberUser) {
                if (++$i > 6) {
                    break;
                }
                $result = [$country, $numberUser];
                $results[] = $result;
            }

            return new JsonResponse([$results, $i-1]);
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

            $result = $userRepository->userRegisterlastDay();

            return new JsonResponse($result);
        }

        return new JsonResponse($result);
    }
}

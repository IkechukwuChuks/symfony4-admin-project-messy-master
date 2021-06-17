<?php

namespace App\Controller\SuperAdmin\Home;

use App\UseCase\User\ListUsersUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexHomeController
 * @package App\Controller\SuperAdmin\Home
 */
class IndexHomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_super_admin_home_index")
     *
     * @param Request $request
     * @param ListUsersUseCase $useCase
     * @return Response
     */
    public function indexAction(Request $request, ListUsersUseCase $useCase): Response
    {
        $page = $request->query->getInt('page', 1);
        return $this->render(
            'SuperAdmin/Home/index.html.twig',
            [
                'users' => $useCase->getPaginatedResults($page)
            ]
        );
    }
}

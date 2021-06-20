<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_user_login")
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('Admin/Security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * Redirect users after login based on the granted ROLE
     * @Route("/login/redirect", name="app_user_login_redirect")
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginRedirectAction(Request $request): RedirectResponse
    {
        if($this->isGranted('ROLE_SUPER_ADMIN'))
        {
            return $this->redirectToRoute('app_super_admin_home_index');
        }
        else if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('app_admin_user_index');
        } else {
            return $this->redirectToRoute('app_user_login');
        }
    }

    /**
     * @Route("/logout", name="app_user_logout")
     */
    public function logoutAction()
    {
    }
}

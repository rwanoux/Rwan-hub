<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(Request $request): Response
    {
        // Get the referer URL to redirect to after logout
        $refererUrl = $request->headers->get('referer');

        // Log the user out
        $this->container->get('security.token_storage')->setToken(null);
        $this->container->get('session')->invalidate();

        // Redirect to homepage after logout if no referer is set
        if (!$refererUrl) {
            $refererUrl = $this->generateUrl('homepage');
        }

        return $this->redirect($refererUrl);
    }
}
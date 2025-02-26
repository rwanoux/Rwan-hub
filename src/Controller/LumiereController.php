<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LumiereController extends AbstractController
{
    #[Route('/lumiere', name: 'app_lumiere')]
    public function index(): Response
    {
        return $this->render('lumiere/index.html.twig', [
            'controller_name' => 'LumiereController',
        ]);
    }
}

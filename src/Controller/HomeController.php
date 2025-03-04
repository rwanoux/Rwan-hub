<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\RouteCollection;


final class HomeController extends AbstractController
{


    #[Route('/', name: 'app_home')]
    public function index(RouterInterface $router): Response
    {
        /** @var RouteCollection $routeCollection */
        $routeCollection = $router->getRouteCollection();

        $routes = [];

        /** @var Route $route */
        foreach ($routeCollection->all() as $name => $route) {
            if (str_starts_with($name, 'app_')) {
                $routes[] = [
                    'name' => $name,
                    'path' => $route->getPath(),
                    'methods' => $route->getMethods(),

                ];
            }
        }



        $user = $this->getUser();
        return $this->render('home/index.html.twig', [
            'title' => 'HomeController',
            'user' => $user,
            'routes' => $routes
        ]);
    }
}

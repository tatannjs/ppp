<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    'template' => 'home.html.twig'
]));

$routes->add('studies', new Route('/studies/{year}', [
    '_controller' => "App\Controller\StudyController::showYear"
]));

return $routes;

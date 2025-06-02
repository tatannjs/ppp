<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $isHtmx = $request->headers->get('Hx-Request');

        if ($isHtmx) {
            return $this->render('partials/page/home.html.twig');
        } else {
            return $this->render('page/home.html.twig');
        }
    }
}

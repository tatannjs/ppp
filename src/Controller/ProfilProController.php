<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilProController extends AbstractController
{
    #[Route('/profilPro', name: 'app_profilPro')]
    public function showProfilPro(Request $request): Response
    {
        $isHtmx = $request->headers->get('Hx-Request');

        if ($isHtmx) {
            return $this->render('partials/page/profilPro.html.twig');
        }else {
            return $this->render('page/profilPro.html.twig');
        }
    }
}
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class StudyController
{
    public function showYear(Request $request, Environment $twig): Response
    {
        $year = $request->attributes->get('year');
        
        return new Response($twig->render('studies.html.twig', [
                'year' => $year
        ]));
    }
}

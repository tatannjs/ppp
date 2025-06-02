<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class StudyController extends AbstractController
{
    private string $projectDir;

    public function __construct(ParameterBagInterface $params)
    {
        $this->projectDir = $params->get('kernel.project_dir');
    }

    /**
     * Récupère tous les numéros de fichiers skillX.html.twig dans l'année donnée.
     */
    private function getSkills(int $year): array
    {
        $templateDir = $this->projectDir . '/templates/partials/page/studies/year' . $year;

        $finder = new Finder();
        $skillNumbers = [];

        if (is_dir($templateDir)) {
            $finder->files()->in($templateDir)->name('/^skill\d+\.html\.twig$/');

            foreach ($finder as $file) {
                if (preg_match('/skill(\d+)\.html\.twig$/', $file->getFilename(), $matches)) {
                    $skillNumbers[] = (int)$matches[1];
                }
            }

            sort($skillNumbers);
        }

        return $skillNumbers;
    }

    #[Route('/studies/{year}', name: 'app_studies')]
    public function showYear(Request $request, int $year): Response
    {
        $skills = $this->getSkills($year);
        $skill = $request->query->getInt('skill', $skills[0] ?? 1);

        $isHtmx = $request->headers->get('Hx-Request');

        if ($isHtmx) {
            return $this->render('partials/page/studies.html.twig', [
                'year' => $year,
                'skill' => $skill,
                'skills' => $skills,
            ]);
        } else {
            return $this->render('page/studies.html.twig', [
                'year' => $year,
                'skill' => $skill,
                'skills' => $skills,
            ]);
        }
    }
}

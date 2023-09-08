<?php

namespace App\Controller\App;

use App\Repository\ActualiteRepository;
use App\Repository\ChampionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/champions', name: 'app_champions')]
class ChampionController extends AbstractController {

    #[Route('/', name: '_lister')]
    public function lister(ChampionRepository $championRepository): Response {
        return $this->render('app/champion/index.html.twig', [
            'champions' => $championRepository->findAll()
        ]);
    }
}

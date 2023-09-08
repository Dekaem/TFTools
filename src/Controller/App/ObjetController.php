<?php

namespace App\Controller\App;

use App\Repository\ActualiteRepository;
use App\Repository\ChampionRepository;
use App\Repository\ObjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/objets', name: 'app_objets')]
class ObjetController extends AbstractController {

    #[Route('/', name: '_lister')]
    public function lister(ObjetRepository $objetRepository): Response {
        return $this->render('app/objet/index.html.twig', [
            'objets' => $objetRepository->findAll()
        ]);
    }
}

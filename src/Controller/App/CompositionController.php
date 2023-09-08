<?php

namespace App\Controller\App;

use App\Repository\ActualiteRepository;
use App\Repository\ChampionRepository;
use App\Repository\CompositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compositions', name: 'app_compositions')]
class CompositionController extends AbstractController {

    #[Route('/', name: '_lister')]
    public function lister(CompositionRepository $compositionRepository): Response {
        return $this->render('app/composition/index.html.twig', [
            'compositions' => $compositionRepository->findAll()
        ]);
    }
}

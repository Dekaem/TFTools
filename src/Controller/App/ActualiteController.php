<?php

namespace App\Controller\App;

use App\Repository\ActualiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actualites', name: 'app_actualites')]
class ActualiteController extends AbstractController {

    #[Route('/', name: '_lister')]
    public function lister(ActualiteRepository $actualiteRepository): Response {
        return $this->render('app/actualite/index.html.twig', [
            'actualites' => $actualiteRepository->findAll()
        ]);
    }
}

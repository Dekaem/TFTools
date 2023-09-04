<?php

namespace App\Controller\Admin;

use App\Repository\ActualiteRepository;
use App\Repository\ChampionRepository;
use App\Repository\CompositionRepository;
use App\Repository\OrigineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(
        ActualiteRepository $actualiteRepository,
        ChampionRepository $championRepository,
        CompositionRepository $compositionRepository,
        OrigineRepository $origineRepository
    ): Response {


        return $this->render('admin/admin_content.html.twig', [
            'nombreActu' => count($actualiteRepository->findAll()),
            'nombreChamp' => count($championRepository->findAll()),
            'nombreCompo' => count($compositionRepository->findAll()),
            'nombreOrigine' => count($origineRepository->findAll())
        ]);
    }
}

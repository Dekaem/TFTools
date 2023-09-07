<?php

namespace App\Controller\Admin;

use App\Repository\ActualiteRepository;
use App\Repository\ChampionRepository;
use App\Repository\CompositionRepository;
use App\Repository\ItemRepository;
use App\Repository\LegendeRepository;
use App\Repository\ObjetRepository;
use App\Repository\OrigineRepository;
use App\Repository\PalierOrigineRepository;
use App\Repository\PalierRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(
        UserRepository $userRepository,
        ActualiteRepository $actualiteRepository,
        ItemRepository $itemRepository,
        ObjetRepository $objetRepository,
        OrigineRepository $origineRepository,
        PalierOrigineRepository $palierOrigineRepository,
        ChampionRepository $championRepository,
        CompositionRepository $compositionRepository,
        LegendeRepository $legendeRepository
    ): Response {


        return $this->render('admin/admin_content.html.twig', [
            'nombreUser' => count($userRepository->findAll()),
            'nombreActu' => count($actualiteRepository->findAll()),
            'nombreItem' => count($itemRepository->findAll()),
            'nombreObjet' => count($objetRepository->findAll()),
            'nombreOrigine' => count($origineRepository->findAll()),
            'nombrePalier' => count($palierOrigineRepository->findAll()),
            'nombreChamp' => count($championRepository->findAll()),
            'nombreCompo' => count($compositionRepository->findAll()),
            'nombreLegende' => count($legendeRepository->findAll())
        ]);
    }
}

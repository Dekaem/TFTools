<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChampionController extends AbstractController
{
    #[Route('/admin_champion', name: 'app_champion')]
    public function index(): Response
    {
        return $this->render('champion/index.html.twig', [
            'controller_name' => 'ChampionController',
        ]);
    }
}

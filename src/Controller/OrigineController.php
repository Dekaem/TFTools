<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrigineController extends AbstractController
{
    #[Route('/origine', name: 'app_origine')]
    public function index(): Response
    {
        return $this->render('origine/index.html.twig', [
            'controller_name' => 'OrigineController',
        ]);
    }
}

<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompositionController extends AbstractController
{
    #[Route('/composition', name: 'composition')]
    public function index(): Response
    {
        return $this->render('composition/index.html.twig', [
            'controller_name' => 'CompositionController',
        ]);
    }
}

<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'compte')]
    public function index(): Response
    {
        return $this->render('app/compte/index.html.twig', [
        ]);
    }
}

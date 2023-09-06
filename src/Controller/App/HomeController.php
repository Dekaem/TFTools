<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    #[Route('/', name: 'home')]
    public function index(): Response {
        return $this->render('app/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
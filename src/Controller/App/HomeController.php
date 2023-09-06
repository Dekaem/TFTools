<?php

namespace App\Controller\App;

use App\Entity\Item;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'home')]
class HomeController extends AbstractController {
    #[Route('/', name: '')]
    public function index(): Response {
        return $this->render('app/home/index.html.twig');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\PalierOrigine;
use App\Form\PalierOrigineType;
use App\Form\PalierType;
use App\Repository\PalierOrigineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/palier', name: 'admin_palier')]
class AdminPalierOrigineController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(PalierOrigineRepository $palierRepository): Response {
        return $this->render('admin/admin_palier_origine/index.html.twig', [
            'paliers' => $palierRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, PalierOrigine $palier): Response {

        $msg = $palier->getId() == null ? 'Le palier a été ajouté avec succès !' : 'Le palier a été modifié avec succès !';
        $form = $this->createForm(PalierOrigineType::class, $palier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($palier);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_palier_lister');
        }

        return $this->render('admin/admin_palier_origine/ajouter.html.twig', [
            'form' => $form,
            'action' => $palier->getId() == null ? 'Ajouter' : 'Modifier'
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, PalierOrigine $palier): Response {

        $entityManager->remove($palier);
        $entityManager->flush();
        $this->addFlash('success', 'Le palier a été supprimé avec succès !');
        return $this->redirectToRoute('admin_palier_lister');
    }
}

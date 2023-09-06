<?php

namespace App\Controller\Admin;

use App\Entity\Legende;
use App\Form\LegendeType;
use App\Repository\LegendeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/admin_legende', name: 'admin_legende')]
class AdminLegendeController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(LegendeRepository $legendeRepository): Response {
        return $this->render('admin/admin_legende/index.html.twig', [
            'legendes' => $legendeRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, Legende $legende): Response {

        $msg = $legende->getId() == null ? 'La légende a été ajoutée avec succès !' : 'La légende a été modifiée avec succès !';
        $form = $this->createForm(LegendeType::class, $legende);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($legende);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_legende_lister');
        }

        return $this->render('admin/admin_legende/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, Legende $legende): Response {

        $entityManager->remove($legende);
        $entityManager->flush();
        $this->addFlash('success', 'La légende a été supprimée avec succès !');
        return $this->redirectToRoute('admin_legende_lister');
    }
}

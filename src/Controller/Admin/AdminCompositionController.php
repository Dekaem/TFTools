<?php

namespace App\Controller\Admin;

use App\Entity\Composition;
use App\Form\CompositionType;
use App\Repository\CompositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/composition', name: 'admin_composition')]
class AdminCompositionController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(CompositionRepository $compositionRepository): Response  {
        return $this->render('admin/admin_composition/index.html.twig', [
            'compositions' => $compositionRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, Composition $composition): Response {

        $msg = $composition->getId() == null ? 'La composition a été ajoutée avec succès !' : 'La composition a été modifiée avec succès !';
        $form = $this->createForm(CompositionType::class, $composition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($composition);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_composition_lister');
        }

        return $this->render('admin/admin_composition/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, Composition $composition): Response {

        $entityManager->remove($composition);
        $entityManager->flush();
        $this->addFlash('success', 'La composition a été supprimée avec succès !');
        return $this->redirectToRoute('admin_composition_lister');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/objet', name: 'admin_objet')]
class AdminObjetController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(ObjetRepository $objetRepository): Response {
        return $this->render('admin/admin_objet/index.html.twig', [
            'objets' => $objetRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, Objet $objet): Response {

        $msg = $objet->getId() == null ? "L'objet a été ajouté avec succès !" : "L'objet a été modifié avec succès !";
        $form = $this->createForm(ObjetType::class, $objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($objet);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_objet_lister');
        }

        return $this->render('admin/admin_objet/ajouter.html.twig', [
            'form' => $form,
            'objet' => $objet->getNom(),
            'action' => $objet->getId() == null ? 'Ajouter' : 'Modifier'
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, Objet $objet): Response {

        $entityManager->remove($objet);
        $entityManager->flush();
        $this->addFlash('success', "L'objet a été supprimé avec succès !");
        return $this->redirectToRoute('admin_objet_lister');
    }
}

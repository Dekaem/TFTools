<?php

namespace App\Controller\Admin;

use App\Entity\Champion;
use App\Form\ChampionType;
use App\Repository\ChampionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/champion', name: 'admin_champion')]
class AdminChampionController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(ChampionRepository $championRepository): Response {
        return $this->render('admin/admin_champion/index.html.twig', [
            'champions' => $championRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, Champion $champion): Response {

        $msg = $champion->getId() == null ? 'Le champion a été ajouté avec succès !' : 'Le champion a été modifié avec succès !';
        $form = $this->createForm(ChampionType::class, $champion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($champion);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_champion_lister');
        }

        return $this->render('admin/admin_champion/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, Champion $champion): Response {

        $entityManager->remove($champion);
        $entityManager->flush();
        $this->addFlash('success', 'Le champion a été supprimé avec succès !');
        return $this->redirectToRoute('admin_champion_lister');
    }
}

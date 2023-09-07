<?php

namespace App\Controller\Admin;

use App\Entity\Origine;
use App\Form\OrigineType;
use App\Repository\OrigineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/trait', name: 'admin_origine')]
class AdminOrigineController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(OrigineRepository $origineRepository): Response {
        return $this->render('admin/admin_origine/index.html.twig', [
            'origines' => $origineRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, Origine $origine): Response {

        $msg = $origine->getId() == null ? "Le trait a été ajouté avec succès !" : "Le trait a été modifié avec succès !";
        $form = $this->createForm(OrigineType::class, $origine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($origine);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_origine_lister');
        }

        return $this->render('admin/admin_origine/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, Origine $origine): Response {

        $entityManager->remove($origine);
        $entityManager->flush();
        $this->addFlash('success', "Le trait a été supprimé avec succès !");
        return $this->redirectToRoute('admin_origine_lister');
    }
}

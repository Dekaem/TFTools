<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use App\Form\ItemType;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/item', name: 'admin_item')]
class AdminItemController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(ItemRepository $itemRepository): Response {
        return $this->render('admin/admin_item/index.html.twig', [
            'items' => $itemRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, Item $item): Response {

        $msg = $item->getId() == null ? "L'item a été ajouté avec succès !" : "L'item a été modifié avec succès !";
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($item);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_item_lister');
        }

        return $this->render('admin/admin_item/ajouter.html.twig', [
            'form' => $form,
            'item' => $item->getNom(),
            'action' => $item->getId() == null ? 'Ajouter' : 'Modifier'
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, Item $item): Response {

        $entityManager->remove($item);
        $entityManager->flush();
        $this->addFlash('success', "L'item a été supprimé avec succès !");
        return $this->redirectToRoute('admin_item_lister');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use App\Service\UploadService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/actualite', name: 'admin_actualite')]
class AdminActualiteController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(ActualiteRepository $actualiteRepository): Response  {
        return $this->render('admin/admin_actualite/index.html.twig', [
            'actualites' => $actualiteRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger,
        UploadService $uploadService,
        Actualite $actualite
    ): Response {

        $msg = $actualite->getId() == null ? "L'actualité a été ajoutée avec succès !" : "L'actualité a été modifiée avec succès !";
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('illustration')->getData();

            if ($file) {
                $newFilename = $uploadService->uploadFile($file, $this->getParameter('uploads_actualites_directory'));
                $actualite->setIllustration($newFilename);
            }

            $actualite->setDatePublication(new \DateTime());

            $entityManager->persist($actualite);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_actualite_lister');
        }

        return $this->render('admin/admin_actualite/ajouter.html.twig', [
            'form' => $form,
            'action' => $actualite->getId() == null ? 'Ajouter' : 'Modifier',
            'illu' => $actualite->getIllustration()
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, Actualite $actualite): Response {

        $entityManager->remove($actualite);
        $entityManager->flush();
        $this->addFlash('success', "L'actualité a été supprimée avec succès !");
        return $this->redirectToRoute('admin_actualite_lister');
    }
}

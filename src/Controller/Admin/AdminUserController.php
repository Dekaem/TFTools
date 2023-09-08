<?php

namespace App\Controller\Admin;

use App\Entity\Champion;
use App\Entity\User;
use App\Form\ChampionType;
use App\Form\UserType;
use App\Repository\ChampionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/user', name: 'admin_user')]
class AdminUserController extends AbstractController {
    #[Route('/', name: '_lister')]
    public function lister(UserRepository $userRepository): Response {
        return $this->render('admin/admin_user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher, User $user): Response {

        $msg = $user->getId() == null ? "L'utilisateur a été ajouté avec succès !" : "L'utilisateur a été modifié avec succès !";
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('mdp')->getData() != null) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('mdp')->getData()
                    )
                );
            }

            if ($form->get('choixRole')->getData() == 'admin') {
                $user->setRoles(['ROLE_ADMIN']);
            } elseif ($form->get('choixRole')->getData() == 'user') {
                $user->setRoles(['ROLE_USER']);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', $msg);
            return $this->redirectToRoute('admin_user_lister');
        }

        return $this->render('admin/admin_user/ajouter.html.twig', [
            'form' => $form,
            'action' => $user->getId() == null ? 'Ajouter' : 'Modifier'
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimer(EntityManagerInterface $entityManager, User $user): Response {

        if ($this->getUser() === $user) {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer cet utilisateur car il est actuellement connecté.');
            return $this->redirectToRoute('admin_user_lister');
        }

        $entityManager->remove($user);
        $entityManager->flush();
        $this->addFlash('success', "L'utilisateur a été supprimé avec succès !");
        return $this->redirectToRoute('admin_user_lister');
    }
}

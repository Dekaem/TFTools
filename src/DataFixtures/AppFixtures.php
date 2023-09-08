<?php

namespace App\DataFixtures;

use App\Entity\Actualite;
use App\Entity\Champion;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager) {

        // ------ Set functions
        function setUsers($pseudo, $email, $pwd, $role, $riot, $mng, $hasher) {
            $user = new User();
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($hasher->hashPassword($user, $pwd));
            $user->setRoles([$role]);
            $user->setRiotAccount($riot);
            $mng->persist($user);
        }

        function setActualites($titre, $texte, $illu, $date, $mng) {
            $actu = new Actualite();
            $actu->setTitre($titre);
            $actu->setTexte($texte);
            $actu->setIllustration($illu);
            $actu->setDatePublication(new \DateTime($date));
            $mng->persist($actu);
        }

        function setChampions($nom, $tier, $desc, $mng) {
            $champ = new Champion();
            $champ->setNom($nom);
            $champ->setTier($tier);
            $champ->setDescription($desc);
            $mng->persist($champ);
        }

        // ------ Utilisateurs par défaut (2)
            setUsers('Admin', 'admin@tftools.fr', 'admin', 'ROLE_ADMIN', false, $manager, $this->hasher);
            setUsers('ZERO DÉTAIL', 'zero@detail.fr', '1l@veTFT', 'ROLE_USER', true, $manager, $this->hasher);

        // ------ Actualités (3)
            $actuTitre1 = "Tactiques : Équipe d'analyse de jeu";
            $actuTexte1 = "Dans le monde rapide et en constante évolution de TFT, un groupe de héros connu sous le nom de GAT (Game Analysis Team) joue un rôle crucial dans les coulisses. Leur mission est de contribuer à l'équilibrage du live et à la conception des décors en garantissant une expérience de jeu optimale pour TFT avant même qu'un set ne soit lancé jusqu'au tout dernier patch.";
            $actuIllu1 = 'heimerdinger-tft-4K-64fa52244606f.jpg';
            setActualites($actuTitre1, $actuTexte1, $actuIllu1, '2022-02-11', $manager);

            $actuTitre2 = "Infos du tournoi mondial TFT";
            $actuTexte2 = "Du 3 au 5 décembre 2022, les 32 meilleurs joueurs au monde s'affronteront dans l'aventure d'une vie où seul le plus puissant des concurrents sera digne de la Spatule dorée et de 150 000 $.";
            $actuIllu2 = 'pingu-tft-4K-64fa5231dd5bb.jpg';
            setActualites($actuTitre2, $actuTexte2, $actuIllu2, '2022-10-09', $manager);

            $actuTitre3 = "RUNETERRA REFORGED : Aperçu du gameplay d'Horizonbound";
            $actuTexte3 = "La tempête de Convergence qui a reforgé Runeterra a frappé un front chaud – attendez-vous à des vents forts, une humidité élevée et une flopée de pirates – arrrgh ! Dans cet article, je vais aborder la plupart du nouveau contenu de gameplay, comment utiliser chaque pièce le premier jour (le 13 septembre) et bien sûr, faire quelques blagues en cours de route. Très bien, mettons les voiles : d'abord, Bilgewater !";
            $actuIllu3 = 'nafiri-tft-4K-64fa52494665b.jpg';
            setActualites($actuTitre3, $actuTexte3, $actuIllu3, '2022-04-06', $manager);
        $manager->flush();
    }
}

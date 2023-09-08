<?php

namespace App\DataFixtures;

use App\Entity\Actualite;
use App\Entity\Champion;
use App\Entity\Composition;
use App\Entity\Item;
use App\Entity\Legende;
use App\Entity\Objet;
use App\Entity\Origine;
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
        function setUsers($pseudo, $email, $pwd, $role, $riot, $mng, $hasher): void {
            $user = new User();
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            $user->setPassword($hasher->hashPassword($user, $pwd));
            $user->setRoles([$role]);
            $user->setRiotAccount($riot);
            $mng->persist($user);
        }

        function setActualites($titre, $texte, $illu, $date, $mng): void {
            $actu = new Actualite();
            $actu->setTitre($titre);
            $actu->setTexte($texte);
            $actu->setIllustration($illu);
            $actu->setDatePublication(new \DateTime($date));
            $mng->persist($actu);
        }

        function setChampions($nom, $tier, $origine1, $origne2, $objet1, $objet2, $objet3) {
            $champion = new Champion();
            $champion->setNom($nom);
            $champion->setTier($tier);
            $champion->addOrigine($origine1);
            $champion->addOrigine($origne2);
            $champion->addStuff($objet1);
            $champion->addStuff($objet2);
            $champion->addStuff($objet3);

            return $champion;
        }

        // ------ Utilisateurs par défaut
            setUsers('Admin', 'admin@tftools.fr', 'admin', 'ROLE_ADMIN', false, $manager, $this->hasher);
            setUsers('ZERO DÉTAIL', 'zero@detail.fr', '1l@veTFT', 'ROLE_USER', true, $manager, $this->hasher);

        // ------ Actualités
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

        // ------ Legendes
        $legendeMaitreYi = new Legende();
        $legendeMaitreYi->setNom('Maitre Yi');
        $legendeMaitreYi->setSpecialite('Or');
        $manager->persist($legendeMaitreYi);

        // ------ Items
        $gant = new Item();
        $gant->setNom("Gants d'entraînement");
        $gant->setDescription("+20% de chances de coup critique");
        $manager->persist($gant);

        $baguette = new Item();
        $baguette->setNom("Baguette trop grosse");
        $baguette->setDescription("+10 puissance");
        $manager->persist($baguette);

        $ceinture = new Item();
        $ceinture->setNom("Ceinture du géant");
        $ceinture->setDescription("+150 PV");
        $manager->persist($ceinture);

        $bf = new Item();
        $bf->setNom("BF Glaive");
        $bf->setDescription("+10% de dégâts d'attaque.");
        $manager->persist($bf);

        $larme = new Item();
        $larme->setNom("Larme de la déesse");
        $larme->setDescription("+15 mana");
        $manager->persist($larme);

        // ------ Objets
        $gantelet = new Objet();
        $gantelet->setNom("Gantelet précieux");
        $gantelet->setDescription("Les dégâts de la compétence du porteur peuvent infliger des coups critiques.");
        $gantelet->setEmbleme(false);
        $gantelet->setPremierItem($gant);
        $gantelet->setSecondItem($baguette);
        $manager->persist($gantelet);

        $brisegarde = new Objet();
        $brisegarde->setNom("Brise-Garde");
        $brisegarde->setDescription("Après avoir infligé des dégâts à un ennemi protégé par un bouclier, les compétences et les attaques du porteur infligent 25% de dégâts supplémentaires pendant 3 sec.");
        $brisegarde->setEmbleme(false);
        $brisegarde->setPremierItem($gant);
        $brisegarde->setSecondItem($ceinture);
        $manager->persist($brisegarde);

        $shojin = new Objet();
        $shojin->setNom("Lance de Shojin");
        $shojin->setDescription("Les attaques du porteur lui rendent 5 pts de mana supplémentaires.");
        $shojin->setEmbleme(false);
        $shojin->setPremierItem($bf);
        $shojin->setSecondItem($larme);
        $manager->persist($shojin);


        // ------ Origines
        $challenger = new Origine();
        $challenger->setNom('Challenger');
        $challenger->setDescription("Les challengers bénéficient d'un bonus de vitesse d'attaque. Lorsque leur cible meurt, les Challengers se précipitent vers une nouvelle cible et augmentent leur bonus de vitesse d'attaque de 50 % pendant 2,5 secondes.");
        $challenger->setPlaceMoyenne(1);
        $manager->persist($challenger);

        $neant = new Origine();
        $neant->setNom('Néant');
        $neant->setDescription("Obtenez un œuf vide plaçable. Au début du combat, il se transforme en une horreur indescriptible et projette les ennemis adjacents. Chaque niveau d'étoile du Néant augmente la santé et la puissance de l'horreur de 25 %.");
        $neant->setPlaceMoyenne(2);
        $manager->persist($neant);

        // ------ Champions
        $kaisa = setChampions("Kai'Sa", 4, $challenger, $neant, $gantelet, $brisegarde, $shojin, $manager);
        $manager->persist($kaisa);

        $malzahar = setChampions("Malzahar", 1, $challenger, $neant, $gantelet, $brisegarde, $shojin, $manager);
        $manager->persist($malzahar);

        $belveth = setChampions("Bel'Veth", 5, $challenger, $neant, $brisegarde, $gantelet, $shojin, $manager);
        $manager->persist($belveth);

        $kassadin = setChampions("Kassadin", 2, $challenger, $neant, $gantelet, $brisegarde, $shojin, $manager);
        $manager->persist($kassadin);

        $velkoz = setChampions("Vel'Koz", 3, $challenger, $neant, $gantelet, $shojin, $brisegarde, $manager);
        $manager->persist($velkoz);

        $chogath = setChampions("Cho'Gath", 1, $challenger, $neant, $shojin, $brisegarde, $gantelet, $manager);
        $manager->persist($chogath);

        $reksai = setChampions("Rek'Sai", 3, $challenger, $neant, $shojin, $brisegarde, $gantelet, $manager);
        $manager->persist($reksai);

        $taric = setChampions("Taric", 4, $challenger, $neant, $shojin, $brisegarde, $gantelet, $manager);
        $manager->persist($taric);

        $yasuo = setChampions("Yasuo", 4, $challenger, $neant, $shojin, $brisegarde, $gantelet, $manager);
        $manager->persist($yasuo);

        $compo = new Composition();
        $compo->setNom('Néant Challenger OP');
        $compo->setPlaceMoyenne(1);
        $compo->setLegende($legendeMaitreYi);
        $compo->addChampion($kaisa);
        $compo->addChampion($malzahar);
        $compo->addChampion($kassadin);
        $compo->addChampion($velkoz);
        $compo->addChampion($chogath);
        $compo->addChampion($reksai);
        $compo->addChampion($taric);
        $compo->addChampion($yasuo);
        $manager->persist($compo);

        $manager->flush();
    }
}

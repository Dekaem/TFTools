<?php

namespace App\Entity;

use App\Repository\ChampionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampionRepository::class)]
class Champion {

    const TIERS = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $tier = null;

    #[ORM\ManyToMany(targetEntity: Origine::class, inversedBy: 'champions')]
    private Collection $origines;

    #[ORM\ManyToMany(targetEntity: Composition::class, inversedBy: 'champions')]
    private Collection $compositions;

    #[ORM\ManyToMany(targetEntity: Objet::class, inversedBy: 'champions')]
    private Collection $stuff;

    public function __construct()
    {
        $this->origines = new ArrayCollection();
        $this->compositions = new ArrayCollection();
        $this->stuff = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTier(): ?int
    {
        return $this->tier;
    }

    public function setTier(int $tier): static
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * @return Collection<int, Origine>
     */
    public function getOrigines(): Collection
    {
        return $this->origines;
    }

    public function addOrigine(Origine $origine): static
    {
        if (!$this->origines->contains($origine)) {
            $this->origines->add($origine);
        }

        return $this;
    }

    public function removeOrigine(Origine $origine): static
    {
        $this->origines->removeElement($origine);

        return $this;
    }

    /**
     * @return Collection<int, Composition>
     */
    public function getCompositions(): Collection
    {
        return $this->compositions;
    }

    public function addComposition(Composition $composition): static
    {
        if (!$this->compositions->contains($composition)) {
            $this->compositions->add($composition);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): static
    {
        $this->compositions->removeElement($composition);

        return $this;
    }

    /**
     * @return Collection<int, Objet>
     */
    public function getStuff(): Collection
    {
        return $this->stuff;
    }

    public function addStuff(Objet $stuff): static
    {
        if (!$this->stuff->contains($stuff)) {
            $this->stuff->add($stuff);
        }

        return $this;
    }

    public function removeStuff(Objet $stuff): static
    {
        $this->stuff->removeElement($stuff);

        return $this;
    }
}

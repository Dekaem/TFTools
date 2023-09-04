<?php

namespace App\Entity;

use App\Repository\ChampionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampionRepository::class)]
class Champion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $cout = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $illustration = null;

    #[ORM\ManyToMany(targetEntity: Origine::class, inversedBy: 'champions')]
    private Collection $origines;

    #[ORM\ManyToMany(targetEntity: Composition::class, inversedBy: 'champions')]
    private Collection $compositions;

    public function __construct()
    {
        $this->origines = new ArrayCollection();
        $this->compositions = new ArrayCollection();
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

    public function getCout(): ?int
    {
        return $this->cout;
    }

    public function setCout(int $cout): static
    {
        $this->cout = $cout;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(?string $illustration): static
    {
        $this->illustration = $illustration;

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
}
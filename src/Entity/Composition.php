<?php

namespace App\Entity;

use App\Repository\CompositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompositionRepository::class)]
class Composition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Champion::class, mappedBy: 'compositions')]
    private Collection $champions;

    #[ORM\Column]
    private ?float $placeMoyenne = null;

    #[ORM\ManyToOne(inversedBy: 'compositions')]
    private ?Legende $legende = null;

    public function __construct()
    {
        $this->champions = new ArrayCollection();
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

    /**
     * @return Collection<int, Champion>
     */
    public function getChampions(): Collection
    {
        return $this->champions;
    }

    public function addChampion(Champion $champion): static
    {
        if (!$this->champions->contains($champion)) {
            $this->champions->add($champion);
            $champion->addComposition($this);
        }

        return $this;
    }

    public function removeChampion(Champion $champion): static
    {
        if ($this->champions->removeElement($champion)) {
            $champion->removeComposition($this);
        }

        return $this;
    }

    public function getPlaceMoyenne(): ?float
    {
        return $this->placeMoyenne;
    }

    public function setPlaceMoyenne(float $placeMoyenne): static
    {
        $this->placeMoyenne = $placeMoyenne;

        return $this;
    }

    public function getLegende(): ?Legende
    {
        return $this->legende;
    }

    public function setLegende(?Legende $legende): static
    {
        $this->legende = $legende;

        return $this;
    }
}

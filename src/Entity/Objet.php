<?php

namespace App\Entity;

use App\Repository\ObjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetRepository::class)]
class Objet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $embleme = null;

    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'objets')]
    private Collection $recette;

    #[ORM\ManyToMany(targetEntity: Champion::class, mappedBy: 'stuff')]
    private Collection $champions;

    public function __construct()
    {
        $this->recette = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isEmbleme(): ?bool
    {
        return $this->embleme;
    }

    public function setEmbleme(bool $embleme): static
    {
        $this->embleme = $embleme;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(Item $recette): static
    {
        if (!$this->recette->contains($recette)) {
            $this->recette->add($recette);
        }

        return $this;
    }

    public function removeRecette(Item $recette): static
    {
        $this->recette->removeElement($recette);

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
            $champion->addStuff($this);
        }

        return $this;
    }

    public function removeChampion(Champion $champion): static
    {
        if ($this->champions->removeElement($champion)) {
            $champion->removeStuff($this);
        }

        return $this;
    }
}

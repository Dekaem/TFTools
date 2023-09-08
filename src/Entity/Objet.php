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

    #[ORM\ManyToMany(targetEntity: Champion::class, mappedBy: 'stuff')]
    private Collection $champions;

    #[ORM\ManyToOne(inversedBy: 'objets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $premierItem = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $secondItem = null;

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

    public function getPremierItem(): ?Item
    {
        return $this->premierItem;
    }

    public function setPremierItem(?Item $premierItem): static
    {
        $this->premierItem = $premierItem;

        return $this;
    }

    public function getSecondItem(): ?Item
    {
        return $this->secondItem;
    }

    public function setSecondItem(?Item $secondItem): static
    {
        $this->secondItem = $secondItem;

        return $this;
    }
}

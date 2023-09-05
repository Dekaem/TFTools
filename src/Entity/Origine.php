<?php

namespace App\Entity;

use App\Repository\OrigineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrigineRepository::class)]
class Origine {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Champion::class, mappedBy: 'origines')]
    private Collection $champions;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $placeMoyenne = null;

    #[ORM\OneToMany(mappedBy: 'origine', targetEntity: PalierOrigine::class, orphanRemoval: true)]
    private Collection $palierOrigines;

    public function __construct()
    {
        $this->champions = new ArrayCollection();
        $this->palierOrigines = new ArrayCollection();
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
            $champion->addOrigine($this);
        }

        return $this;
    }

    public function removeChampion(Champion $champion): static
    {
        if ($this->champions->removeElement($champion)) {
            $champion->removeOrigine($this);
        }

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

    public function getPlaceMoyenne(): ?float
    {
        return $this->placeMoyenne;
    }

    public function setPlaceMoyenne(float $placeMoyenne): static
    {
        $this->placeMoyenne = $placeMoyenne;

        return $this;
    }

    /**
     * @return Collection<int, PalierOrigine>
     */
    public function getPalierOrigines(): Collection
    {
        return $this->palierOrigines;
    }

    public function addPalierOrigine(PalierOrigine $palierOrigine): static
    {
        if (!$this->palierOrigines->contains($palierOrigine)) {
            $this->palierOrigines->add($palierOrigine);
            $palierOrigine->setOrigine($this);
        }

        return $this;
    }

    public function removePalierOrigine(PalierOrigine $palierOrigine): static
    {
        if ($this->palierOrigines->removeElement($palierOrigine)) {
            // set the owning side to null (unless already changed)
            if ($palierOrigine->getOrigine() === $this) {
                $palierOrigine->setOrigine(null);
            }
        }

        return $this;
    }
}

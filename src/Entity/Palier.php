<?php

namespace App\Entity;

use App\Repository\PalierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PalierRepository::class)]
class Palier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\OneToMany(mappedBy: 'palier', targetEntity: PalierOrigine::class, orphanRemoval: true)]
    private Collection $palierOrigines;

    public function __construct()
    {
        $this->palierOrigines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

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
            $palierOrigine->setPalier($this);
        }

        return $this;
    }

    public function removePalierOrigine(PalierOrigine $palierOrigine): static
    {
        if ($this->palierOrigines->removeElement($palierOrigine)) {
            // set the owning side to null (unless already changed)
            if ($palierOrigine->getPalier() === $this) {
                $palierOrigine->setPalier(null);
            }
        }

        return $this;
    }
}

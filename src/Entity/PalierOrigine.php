<?php

namespace App\Entity;

use App\Repository\PalierOrigineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PalierOrigineRepository::class)]
class PalierOrigine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'palierOrigines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Palier $palier = null;

    #[ORM\ManyToOne(inversedBy: 'palierOrigines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Origine $origine = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPalier(): ?Palier
    {
        return $this->palier;
    }

    public function setPalier(?Palier $palier): static
    {
        $this->palier = $palier;

        return $this;
    }

    public function getOrigine(): ?Origine
    {
        return $this->origine;
    }

    public function setOrigine(?Origine $origine): static
    {
        $this->origine = $origine;

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
}

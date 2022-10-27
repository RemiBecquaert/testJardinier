<?php

namespace App\Entity;

use App\Repository\GraineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: GraineRepository::class)]
class Graine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $periodePlantation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $periodeRecolte = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $conseils = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'lesGraines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Famille $nomFamille = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPeriodePlantation(): ?\DateTimeInterface
    {
        return $this->periodePlantation;
    }

    public function setPeriodePlantation(\DateTimeInterface $periodePlantation): self
    {
        $this->periodePlantation = $periodePlantation;

        return $this;
    }

    public function getPeriodeRecolte(): ?\DateTimeInterface
    {
        return $this->periodeRecolte;
    }

    public function setPeriodeRecolte(\DateTimeInterface $periodeRecolte): self
    {
        $this->periodeRecolte = $periodeRecolte;

        return $this;
    }

    public function getConseils(): ?string
    {
        return $this->conseils;
    }

    public function setConseils(string $conseils): self
    {
        $this->conseils = $conseils;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getNomFamille(): ?Famille
    {
        return $this->nomFamille;
    }

    public function setNomFamille(?Famille $nomFamille): self
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }
}

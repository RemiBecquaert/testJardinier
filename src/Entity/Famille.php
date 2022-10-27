<?php

namespace App\Entity;

use App\Repository\FamilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilleRepository::class)]
class Famille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'nomFamille', targetEntity: Graine::class)]
    private Collection $lesGraines;

    public function __construct()
    {
        $this->lesGraines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Graine>
     */
    public function getLesGraines(): Collection
    {
        return $this->lesGraines;
    }

    public function addLesGraine(Graine $lesGraine): self
    {
        if (!$this->lesGraines->contains($lesGraine)) {
            $this->lesGraines->add($lesGraine);
            $lesGraine->setNomFamille($this);
        }

        return $this;
    }

    public function removeLesGraine(Graine $lesGraine): self
    {
        if ($this->lesGraines->removeElement($lesGraine)) {
            // set the owning side to null (unless already changed)
            if ($lesGraine->getNomFamille() === $this) {
                $lesGraine->setNomFamille(null);
            }
        }

        return $this;
    }
}

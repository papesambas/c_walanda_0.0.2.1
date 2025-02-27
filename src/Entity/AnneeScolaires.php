<?php

namespace App\Entity;

use App\Entity\Caisses;
use App\Entity\FraisScolaires;
use App\Entity\FraisScolarites;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\AnneeScolairesRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AnneeScolairesRepository::class)]
class AnneeScolaires
{
    use CreatedAtTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $anneeDebut = null;

    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $anneeFin = null;

    /**
     * @var Collection<int, Caisses>
     */
    #[ORM\OneToMany(targetEntity: Caisses::class, mappedBy: 'anneeScolaires')]
    private Collection $caisses;

    /**
     * @var Collection<int, FraisScolaires>
     */
    #[ORM\ManyToMany(targetEntity: FraisScolaires::class, mappedBy: 'anneeScolaires')]
    private Collection $fraisScolaires;

    /**
     * @var Collection<int, FraisScolarites>
     */
    #[ORM\OneToMany(targetEntity: FraisScolarites::class, mappedBy: 'anneeScolaires')]
    private Collection $fraisScolarites;

    public function __construct()
    {
        $this->caisses = new ArrayCollection();
        $this->fraisScolaires = new ArrayCollection();
        $this->fraisScolarites = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->anneeDebut.'-'.$this->anneeFin ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeDebut(): ?int
    {
        return $this->anneeDebut;
    }

    public function setAnneeDebut(int $anneeDebut): static
    {
        $this->anneeDebut = $anneeDebut;

        return $this;
    }

    public function getAnneeFin(): ?int
    {
        return $this->anneeFin;
    }

    public function setAnneeFin(int $anneeFin): static
    {
        $this->anneeFin = $anneeFin;

        return $this;
    }

    /**
     * @return Collection<int, Caisses>
     */
    public function getCaisses(): Collection
    {
        return $this->caisses;
    }

    public function addCaiss(Caisses $caiss): static
    {
        if (!$this->caisses->contains($caiss)) {
            $this->caisses->add($caiss);
            $caiss->setAnneeScolaires($this);
        }

        return $this;
    }

    public function removeCaiss(Caisses $caiss): static
    {
        if ($this->caisses->removeElement($caiss)) {
            // set the owning side to null (unless already changed)
            if ($caiss->getAnneeScolaires() === $this) {
                $caiss->setAnneeScolaires(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FraisScolaires>
     */
    public function getFraisScolaires(): Collection
    {
        return $this->fraisScolaires;
    }

    public function addFraisScolaire(FraisScolaires $fraisScolaire): static
    {
        if (!$this->fraisScolaires->contains($fraisScolaire)) {
            $this->fraisScolaires->add($fraisScolaire);
            $fraisScolaire->addAnneeScolaire($this);
        }

        return $this;
    }

    public function removeFraisScolaire(FraisScolaires $fraisScolaire): static
    {
        if ($this->fraisScolaires->removeElement($fraisScolaire)) {
            $fraisScolaire->removeAnneeScolaire($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, FraisScolarites>
     */
    public function getFraisScolarites(): Collection
    {
        return $this->fraisScolarites;
    }

    public function addFraisScolarite(FraisScolarites $fraisScolarite): static
    {
        if (!$this->fraisScolarites->contains($fraisScolarite)) {
            $this->fraisScolarites->add($fraisScolarite);
            $fraisScolarite->setAnneeScolaires($this);
        }

        return $this;
    }

    public function removeFraisScolarite(FraisScolarites $fraisScolarite): static
    {
        if ($this->fraisScolarites->removeElement($fraisScolarite)) {
            // set the owning side to null (unless already changed)
            if ($fraisScolarite->getAnneeScolaires() === $this) {
                $fraisScolarite->setAnneeScolaires(null);
            }
        }

        return $this;
    }
}

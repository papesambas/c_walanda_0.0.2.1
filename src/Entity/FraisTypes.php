<?php

namespace App\Entity;

use App\Entity\FraisScolaires;
use App\Entity\FraisScolarites;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\FraisTypesRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FraisTypesRepository::class)]
class FraisTypes
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 50, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]

    private ?string $periode = null;

    /**
     * @var Collection<int, FraisScolaires>
     */
    #[ORM\OneToMany(targetEntity: FraisScolaires::class, mappedBy: 'fraisTypes')]
    private Collection $fraisScolaires;

    #[ORM\ManyToOne(inversedBy: 'fraisTypes', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Statuts $statut = null;

    #[ORM\ManyToOne(inversedBy: 'fraisTypes', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Niveaux $niveau = null;

    /**
     * @var Collection<int, FraisScolarites>
     */
    #[ORM\OneToMany(targetEntity: FraisScolarites::class, mappedBy: 'fraisTypes')]
    private Collection $fraisScolarites;

    public function __construct()
    {
        $this->fraisScolaires = new ArrayCollection();
        $this->fraisScolarites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): static
    {
        $this->periode = $periode;

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
            $fraisScolaire->setFraisTypes($this);
        }

        return $this;
    }

    public function removeFraisScolaire(FraisScolaires $fraisScolaire): static
    {
        if ($this->fraisScolaires->removeElement($fraisScolaire)) {
            // set the owning side to null (unless already changed)
            if ($fraisScolaire->getFraisTypes() === $this) {
                $fraisScolaire->setFraisTypes(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?Statuts
    {
        return $this->statut;
    }

    public function setStatut(?Statuts $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNiveau(): ?Niveaux
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveaux $niveau): static
    {
        $this->niveau = $niveau;

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
            $fraisScolarite->setFraisTypes($this);
        }

        return $this;
    }

    public function removeFraisScolarite(FraisScolarites $fraisScolarite): static
    {
        if ($this->fraisScolarites->removeElement($fraisScolarite)) {
            // set the owning side to null (unless already changed)
            if ($fraisScolarite->getFraisTypes() === $this) {
                $fraisScolarite->setFraisTypes(null);
            }
        }

        return $this;
    }
}

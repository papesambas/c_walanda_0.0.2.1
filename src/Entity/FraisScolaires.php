<?php

namespace App\Entity;

use App\Entity\AnneeScolaires;
use App\Entity\FraisScolarites;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\FraisScolairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FraisScolairesRepository::class)]
class FraisScolaires
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $designation = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\ManyToOne(inversedBy: 'fraisScolaires', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Echeances $echeance = null;

    #[ORM\ManyToOne(inversedBy: 'fraisScolaires', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?FraisTypes $fraisTypes = null;

    /**
     * @var Collection<int, FraisScolarites>
     */
    #[ORM\ManyToMany(targetEntity: FraisScolarites::class, inversedBy: 'fraisScolaires')]
    private Collection $fraisScolarites;

    /**
     * @var Collection<int, AnneeScolaires>
     */
    #[ORM\ManyToMany(targetEntity: AnneeScolaires::class, inversedBy: 'fraisScolaires')]
    private Collection $anneeScolaires;

    public function __construct()
    {
        $this->fraisScolarites = new ArrayCollection();
        $this->anneeScolaires = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this-> designation ?? '';
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getEcheance(): ?Echeances
    {
        return $this->echeance;
    }

    public function setEcheance(?Echeances $echeance): static
    {
        $this->echeance = $echeance;

        return $this;
    }

    public function getFraisTypes(): ?FraisTypes
    {
        return $this->fraisTypes;
    }

    public function setFraisTypes(?FraisTypes $fraisTypes): static
    {
        $this->fraisTypes = $fraisTypes;

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
        }

        return $this;
    }

    public function removeFraisScolarite(FraisScolarites $fraisScolarite): static
    {
        $this->fraisScolarites->removeElement($fraisScolarite);

        return $this;
    }

    /**
     * @return Collection<int, AnneeScolaires>
     */
    public function getAnneeScolaires(): Collection
    {
        return $this->anneeScolaires;
    }

    public function addAnneeScolaire(AnneeScolaires $anneeScolaire): static
    {
        if (!$this->anneeScolaires->contains($anneeScolaire)) {
            $this->anneeScolaires->add($anneeScolaire);
        }

        return $this;
    }

    public function removeAnneeScolaire(AnneeScolaires $anneeScolaire): static
    {
        $this->anneeScolaires->removeElement($anneeScolaire);

        return $this;
    }
}

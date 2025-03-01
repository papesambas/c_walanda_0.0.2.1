<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\EcheancesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EcheancesRepository::class)]
class Echeances
{
    use CreatedAtTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $echeance = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 20, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]

    private ?string $periode = null;

    /**
     * @var Collection<int, FraisScolaires>
     */
    #[ORM\OneToMany(targetEntity: FraisScolaires::class, mappedBy: 'echeance')]
    private Collection $fraisScolaires;

    public function __construct()
    {
        $this->fraisScolaires = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this-> echeance.'-'.$this->periode ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEcheance(): ?\DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(\DateTimeInterface $echeance): static
    {
        $this->echeance = $echeance;

        return $this;
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
            $fraisScolaire->setEcheance($this);
        }

        return $this;
    }

    public function removeFraisScolaire(FraisScolaires $fraisScolaire): static
    {
        if ($this->fraisScolaires->removeElement($fraisScolaire)) {
            // set the owning side to null (unless already changed)
            if ($fraisScolaire->getEcheance() === $this) {
                $fraisScolaire->setEcheance(null);
            }
        }

        return $this;
    }
}

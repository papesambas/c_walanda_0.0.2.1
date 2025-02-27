<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\SantesRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SantesRepository::class)]
class Santes
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
    private ?string $maladie = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $medecin = null;

    #[ORM\Column(length: 23)]
    private ?string $numeroUrgence = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $centreSante = null;

    #[ORM\ManyToOne(inversedBy: 'santes', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Eleves $eleve = null;

    public function __tostring()
    {
        return $this-> maladie ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaladie(): ?string
    {
        return $this->maladie;
    }

    public function setMaladie(string $maladie): static
    {
        $this->maladie = $maladie;

        return $this;
    }

    public function getMedecin(): ?string
    {
        return $this->medecin;
    }

    public function setMedecin(?string $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getNumeroUrgence(): ?string
    {
        return $this->numeroUrgence;
    }

    public function setNumeroUrgence(string $numeroUrgence): static
    {
        $this->numeroUrgence = $numeroUrgence;

        return $this;
    }

    public function getCentreSante(): ?string
    {
        return $this->centreSante;
    }

    public function setCentreSante(?string $centreSante): static
    {
        $this->centreSante = $centreSante;

        return $this;
    }

    public function getEleve(): ?Eleves
    {
        return $this->eleve;
    }

    public function setEleve(?Eleves $eleve): static
    {
        $this->eleve = $eleve;

        return $this;
    }
}

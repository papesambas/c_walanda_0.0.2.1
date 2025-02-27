<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\DepartsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DepartsRepository::class)]
class Departs
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $motif = null;

    #[ORM\Column(length: 150)]
    private ?string $ecoleDestination = null;

    #[ORM\ManyToOne(inversedBy: 'departs', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Etablissements $ecoleDepart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\ManyToOne(inversedBy: 'depart', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Eleves $eleves = null;

    public function __tostring()
    {
        return $this-> eleves.'-'.$this-> dateDepart ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getEcoleDestination(): ?string
    {
        return $this->ecoleDestination;
    }

    public function setEcoleDestination(string $ecoleDestination): static
    {
        $this->ecoleDestination = $ecoleDestination;

        return $this;
    }

    public function getEcoleDepart(): ?Etablissements
    {
        return $this->ecoleDepart;
    }

    public function setEcoleDepart(?Etablissements $ecoleDepart): static
    {
        $this->ecoleDepart = $ecoleDepart;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getEleves(): ?Eleves
    {
        return $this->eleves;
    }

    public function setEleves(?Eleves $eleves): static
    {
        $this->eleves = $eleves;

        return $this;
    }
}

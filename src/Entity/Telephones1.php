<?php

namespace App\Entity;

use App\Entity\Meres;
use App\Entity\Peres;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Repository\Telephones1Repository;
use symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: Telephones1Repository::class)]
class Telephones1
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'telephone1', cascade: ['persist', 'remove'])]
    private ?Meres $meres = null;

    #[ORM\OneToOne(mappedBy: 'telephone1', cascade: ['persist', 'remove'])]
    private ?Peres $peres = null;

    #[ORM\Column(length: 23, unique: true)]
    #[Assert\Regex(
        pattern: "/^\+223\s\d{2}\s\d{2}\s\d{2}\s\d{2}$/",
        message: "Le numéro de téléphone doit être au format +223 xx xx xx xx."
    )]
    private ?string $numero = null;

    public function __tostring()
    {
        return $this-> numero ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeres(): ?Meres
    {
        return $this->meres;
    }

    public function setMeres(Meres $meres): static
    {
        // set the owning side of the relation if necessary
        if ($meres->getTelephone1() !== $this) {
            $meres->setTelephone1($this);
        }

        $this->meres = $meres;

        return $this;
    }

    public function getPeres(): ?Peres
    {
        return $this->peres;
    }

    public function setPeres(Peres $peres): static
    {
        // set the owning side of the relation if necessary
        if ($peres->getTelephone1() !== $this) {
            $peres->setTelephone1($this);
        }

        $this->peres = $peres;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }
}

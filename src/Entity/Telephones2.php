<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Repository\Telephones2Repository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: Telephones2Repository::class)]
class Telephones2
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'telephone2', cascade: ['persist', 'remove'])]
    private ?Meres $meres = null;

    #[ORM\OneToOne(mappedBy: 'telephone2', cascade: ['persist', 'remove'])]
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

    public function setMeres(?Meres $meres): static
    {
        // unset the owning side of the relation if necessary
        if ($meres === null && $this->meres !== null) {
            $this->meres->setTelephone2(null);
        }

        // set the owning side of the relation if necessary
        if ($meres !== null && $meres->getTelephone2() !== $this) {
            $meres->setTelephone2($this);
        }

        $this->meres = $meres;

        return $this;
    }

    public function getPeres(): ?Peres
    {
        return $this->peres;
    }

    public function setPeres(?Peres $peres): static
    {
        // unset the owning side of the relation if necessary
        if ($peres === null && $this->peres !== null) {
            $this->peres->setTelephone2(null);
        }

        // set the owning side of the relation if necessary
        if ($peres !== null && $peres->getTelephone2() !== $this) {
            $peres->setTelephone2($this);
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

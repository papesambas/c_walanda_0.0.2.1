<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Repository\DetailsCaissesRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: DetailsCaissesRepository::class)]
class DetailsCaisses
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeImmutable $dateOp = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $designation = null;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero()]
    private ?float $debit = null;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero()]
    private ?float $credit = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?float $solde = null;

    #[ORM\Column]
    private ?float $soldeCumul = null;

    #[ORM\ManyToOne(inversedBy: 'detailsCaisses', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Caisses $caisse = null;

    #[ORM\ManyToOne(inversedBy: 'detailsCaisses', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Users $author = null;

    public function __toString(): string
    {
        return $this->dateOp->format('Y-m-d') . ' - ' . $this->designation . ' (Solde: ' . $this->solde . ')';
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->calculateSolde();
        $this->updateCaisseSoldeCumul();
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->calculateSolde();
        $this->updateCaisseSoldeCumul();
    }

    private function calculateSolde(): void
    {
        $this->solde = ($this->debit ?? 0) - ($this->credit ?? 0);
        $this->soldeCumul = ($this->soldeCumul ?? 0) + $this->solde;
    }

    private function updateCaisseSoldeCumul(): void
    {
        if ($this->caisse) {
            $this->caisse->setSoldeCumul($this->caisse->getSoldeCumul() + $this->solde);
        }
    }

    #[Assert\Callback]
    public function validateSolde(ExecutionContextInterface $context): void
    {
        if ($this->solde !== $this->debit - $this->credit) {
            $context->buildViolation("Le solde doit être égal au débit moins le crédit.")
                ->atPath('solde')
                ->addViolation();
        }

        if ($this->soldeCumul !== $this->caisse->getSoldeCumul() + $this->solde) {
            $context->buildViolation("Le solde cumulé doit être égal au solde cumulé de la caisse plus le solde actuel.")
                ->atPath('soldeCumul')
                ->addViolation();
        }
    }    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOp(): ?\DateTimeImmutable
    {
        return $this->dateOp;
    }

    public function setDateOp(\DateTimeImmutable $dateOp): static
    {
        $this->dateOp = $dateOp;

        return $this;
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

    public function getDebit(): ?float
    {
        return $this->debit;
    }

    public function setDebit(?float $debit): static
    {
        $this->debit = $debit;

        return $this;
    }

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function setCredit(?float $credit): static
    {
        $this->credit = $credit;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getSoldeCumul(): ?float
    {
        return $this->soldeCumul;
    }

    public function setSoldeCumul(float $soldeCumul): static
    {
        $this->soldeCumul = $soldeCumul;

        return $this;
    }

    public function getCaisse(): ?Caisses
    {
        return $this->caisse;
    }

    public function setCaisse(?Caisses $caisse): static
    {
        if ($this->caisse !== $caisse) {
            $this->caisse = $caisse;
            $caisse?->addDetailsCaiss($this);
        }
        return $this;
    }

    public function getAuthor(): ?Users
    {
        return $this->author;
    }

    public function setAuthor(?Users $author): static
    {
        if ($this->author !== $author) {
            $this->author = $author;
            $author?->addDetailsCaiss($this);
        }
        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\CaissesRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: CaissesRepository::class)]
class Caisses
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 100, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]

    private ?string $libelle = null;

    #[ORM\Column]
    private ?float $debit = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?float $credit = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?float $solde = null;

    #[ORM\ManyToOne(inversedBy: 'caisses', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'id',)]
    #[Assert\NotBlank()]
    private ?Users $author = null;

    #[ORM\Column]
    private ?float $soldeCumul = null;

    #[ORM\ManyToOne(inversedBy: 'caisses', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'id',)]
    #[Assert\NotBlank()]
    private ?AnneeScolaires $anneeScolaires = null;

    /**
     * @var Collection<int, DetailsCaisses>
     */
    #[ORM\OneToMany(targetEntity: DetailsCaisses::class, mappedBy: 'caisse')]
    private Collection $detailsCaisses;

    #[ORM\ManyToOne(inversedBy: 'caisses', fetch: "LAZY")]
    #[ORM\JoinColumn(referencedColumnName: 'id',)]
    private ?FraisScolarites $fraisScolarites = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeImmutable $dateOp = null;

    public function __construct()
    {
        $this->detailsCaisses = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->libelle . ' ' . $this->author ?? '';
    }

    // Méthode appelée avant l'insertion d'une nouvelle entité
    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->calculateSolde();
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->calculateSolde();
    }

    private function calculateSolde(): void
    {
        // Calcul du solde
        $this->solde = ($this->debit ?? 0) - ($this->credit ?? 0);

        // Calcul du solde cumulé
        $this->soldeCumul = ($this->soldeCumul ?? 0) + $this->solde;
    }

    #[Assert\Callback]
    public function validateSolde(ExecutionContextInterface $context): void
    {
        // Vérifier que le solde est égal au débit moins le crédit
        if ($this->solde !== $this->debit - $this->credit) {
            $context->buildViolation("Le solde doit être égal au débit moins le crédit.")
                ->atPath('solde')
                ->addViolation();
        }

        // Vérifier que le solde cumulé est cohérent
        if ($this->soldeCumul !== $this->getInitialSoldeCumul() + $this->solde) {
            $context->buildViolation("Le solde cumulé doit être égal au solde cumulé initial plus le solde actuel.")
                ->atPath('soldeCumul')
                ->addViolation();
        }
    }

    private function getInitialSoldeCumul(): float
    {
        // Retourne le solde cumulé initial (par exemple, à partir de la base de données)
        return $this->soldeCumul - $this->solde;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDebit(): ?float
    {
        return $this->debit;
    }

    public function setDebit(float $debit): static
    {
        $this->debit = $debit;

        return $this;
    }

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function setCredit(float $credit): static
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

    public function getAuthor(): ?Users
    {
        return $this->author;
    }

    public function setAuthor(?Users $author): static
    {
        $this->author = $author;

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

    public function getAnneeScolaires(): ?AnneeScolaires
    {
        return $this->anneeScolaires;
    }

    public function setAnneeScolaires(?AnneeScolaires $anneeScolaires): static
    {
        $this->anneeScolaires = $anneeScolaires;

        return $this;
    }

    /**
     * @return Collection<int, DetailsCaisses>
     */
    public function getDetailsCaisses(): Collection
    {
        return $this->detailsCaisses;
    }

    public function addDetailsCaiss(DetailsCaisses $detailsCaiss): static
    {
        if (!$this->detailsCaisses->contains($detailsCaiss)) {
            $this->detailsCaisses->add($detailsCaiss);
            $detailsCaiss->setCaisse($this);
        }

        return $this;
    }

    public function removeDetailsCaiss(DetailsCaisses $detailsCaiss): static
    {
        if ($this->detailsCaisses->removeElement($detailsCaiss)) {
            // set the owning side to null (unless already changed)
            if ($detailsCaiss->getCaisse() === $this) {
                $detailsCaiss->setCaisse(null);
            }
        }

        return $this;
    }

    public function getFraisScolarites(): ?FraisScolarites
    {
        return $this->fraisScolarites;
    }

    public function setFraisScolarites(?FraisScolarites $fraisScolarites): static
    {
        $this->fraisScolarites = $fraisScolarites;

        return $this;
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
}

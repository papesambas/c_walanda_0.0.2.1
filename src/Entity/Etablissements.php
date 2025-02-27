<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\EtablissementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EtablissementsRepository::class)]
class Etablissements
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

    #[ORM\Column(length: 75)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 75, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $formeJuridique = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 50, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $numDecisionCreation = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 50, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $numDecisionOuverture = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeInterface $dateOuverture = null;

    #[ORM\Column(length: 75, nullable: true, unique: true)]
    private ?string $numSocial = null;

    #[ORM\Column(length: 75, nullable: true, unique: true)]
    private ?string $numFiscal = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $numCpteBancaire = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 255, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $adresse = null;

    #[ORM\Column(length: 23)]
    #[Assert\NotBlank(message: "Le numéro de téléphone est obligatoire.")]
    #[Assert\Regex(
        pattern: "/^\+223\s\d{2}\s\d{2}\s\d{2}\s\d{2}$/",
        message: "Le numéro de téléphone doit être au format +223 xx xx xx xx."
    )]
    private ?string $telephone = null;

    #[ORM\Column(length: 23, nullable: true)]
    #[Assert\Regex(
        pattern: "/^\+223\s\d{2}\s\d{2}\s\d{2}\s\d{2}$/",
        message: "Le numéro de téléphone doit être au format +223 xx xx xx xx."
    )]
    private ?string $telephoneMobile = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'id',)]
    private ?Enseignements $enseignement = null;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero()]
    private ?int $capacite = 0;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero()]
    private ?int $effectif = 0;

    /**
     * @var Collection<int, Cycles>
     */
    #[ORM\OneToMany(targetEntity: Cycles::class, mappedBy: 'etablissement')]
    private Collection $cycles;

    /**
     * @var Collection<int, Departs>
     */
    #[ORM\OneToMany(targetEntity: Departs::class, mappedBy: 'ecoleDepart')]
    private Collection $departs;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'etablissements')]
    private Collection $user;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    public function __construct()
    {
        $this->cycles = new ArrayCollection();
        $this->departs = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->designation ?? '';
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

    public function getFormeJuridique(): ?string
    {
        return $this->formeJuridique;
    }

    public function setFormeJuridique(string $formeJuridique): static
    {
        $this->formeJuridique = $formeJuridique;

        return $this;
    }

    public function getNumDecisionCreation(): ?string
    {
        return $this->numDecisionCreation;
    }

    public function setNumDecisionCreation(string $numDecisionCreation): static
    {
        $this->numDecisionCreation = $numDecisionCreation;

        return $this;
    }

    public function getNumDecisionOuverture(): ?string
    {
        return $this->numDecisionOuverture;
    }

    public function setNumDecisionOuverture(string $numDecisionOuverture): static
    {
        $this->numDecisionOuverture = $numDecisionOuverture;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->dateOuverture;
    }

    public function setDateOuverture(\DateTimeInterface $dateOuverture): static
    {
        $this->dateOuverture = $dateOuverture;

        return $this;
    }

    public function getNumSocial(): ?string
    {
        return $this->numSocial;
    }

    public function setNumSocial(?string $numSocial): static
    {
        $this->numSocial = $numSocial;

        return $this;
    }

    public function getNumFiscal(): ?string
    {
        return $this->numFiscal;
    }

    public function setNumFiscal(?string $numFiscal): static
    {
        $this->numFiscal = $numFiscal;

        return $this;
    }

    public function getNumCpteBancaire(): ?string
    {
        return $this->numCpteBancaire;
    }

    public function setNumCpteBancaire(?string $numCpteBancaire): static
    {
        $this->numCpteBancaire = $numCpteBancaire;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTelephoneMobile(): ?string
    {
        return $this->telephoneMobile;
    }

    public function setTelephoneMobile(?string $telephoneMobile): static
    {
        $this->telephoneMobile = $telephoneMobile;

        return $this;
    }

    public function getEnseignement(): ?Enseignements
    {
        return $this->enseignement;
    }

    public function setEnseignement(?Enseignements $enseignement): static
    {
        $this->enseignement = $enseignement;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(?int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getEffectif(): ?int
    {
        return $this->effectif;
    }

    public function setEffectif(?int $effectif): static
    {
        $this->effectif = $effectif;

        return $this;
    }

    /**
     * @return Collection<int, Cycles>
     */
    public function getCycles(): Collection
    {
        return $this->cycles;
    }

    public function addCycle(Cycles $cycle): static
    {
        if (!$this->cycles->contains($cycle)) {
            $this->cycles->add($cycle);
            $cycle->setEtablissement($this);
        }

        return $this;
    }

    public function removeCycle(Cycles $cycle): static
    {
        if ($this->cycles->removeElement($cycle)) {
            // set the owning side to null (unless already changed)
            if ($cycle->getEtablissement() === $this) {
                $cycle->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Departs>
     */
    public function getDeparts(): Collection
    {
        return $this->departs;
    }

    public function addDepart(Departs $depart): static
    {
        if (!$this->departs->contains($depart)) {
            $this->departs->add($depart);
            $depart->setEcoleDepart($this);
        }

        return $this;
    }

    public function removeDepart(Departs $depart): static
    {
        if ($this->departs->removeElement($depart)) {
            // set the owning side to null (unless already changed)
            if ($depart->getEcoleDepart() === $this) {
                $depart->setEcoleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setEtablissements($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEtablissements() === $this) {
                $user->setEtablissements(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}

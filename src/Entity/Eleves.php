<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\ElevesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ElevesRepository::class)]
class Eleves
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'eleves_images', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 30, unique: true)]

    private ?string $matricule = null;

    #[ORM\Column(length: 2)]
    private ?string $sexe = 'M';

    #[ORM\Column(length: 8)]
    private ?string $statutFinance = "Privé(e)";

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeInterface $dateExtrait = null;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank()]
    private ?string $numExtrait = null;

    #[ORM\Column]
    private ?bool $isAdmis = true;

    #[ORM\Column]
    private ?bool $isActif = true;

    #[ORM\Column]
    private ?bool $isAllowed = true;

    #[ORM\Column]
    private ?bool $isHandicap = false;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $natureHandicape = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeInterface $dateRecrutement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $fullname = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Noms $nom = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Prenoms $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?LieuNaissances $lieuNaissance = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Classes $classe = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Departements $departement = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: true,referencedColumnName: 'id',)]
    private ?Scolarites1 $scolarite1 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: true,referencedColumnName: 'id',)]
    private ?Scolarites2 $scolarite2 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: true,referencedColumnName: 'id',)]
    private ?Redoublements1 $redoublement1 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: true,referencedColumnName: 'id',)]
    private ?Redoublements2 $redoublement2 = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: true,referencedColumnName: 'id',)]
    private ?Redoublements3 $redoublement3 = null;

    #[ORM\OneToOne(inversedBy: 'eleves', cascade: ['persist', 'remove'], fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Users $user = null;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Parents $parent = null;

    /**
     * @var Collection<int, Departs>
     */
    #[ORM\OneToMany(targetEntity: Departs::class, mappedBy: 'eleves')]
    private Collection $depart;

    #[ORM\OneToOne(mappedBy: 'eleves', cascade: ['persist', 'remove'])]
    private ?FraisScolarites $fraisScolarites = null;

    /**
     * @var Collection<int, Santes>
     */
    #[ORM\OneToMany(targetEntity: Santes::class, mappedBy: 'eleve')]
    private Collection $santes;

    #[ORM\ManyToOne(inversedBy: 'eleves', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Statuts $statuts = null;

    /**
     * @var Collection<int, DossierEleves>
     */
    #[ORM\OneToMany(targetEntity: DossierEleves::class, mappedBy: 'eleves')]
    private Collection $dossierEleves;

    #[ORM\ManyToOne(inversedBy: 'elevesAnDernier')]
    private ?EcoleProvenances $ecoleAnDernier = null;

    #[ORM\ManyToOne(inversedBy: 'elevesRecrutes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EcoleProvenances $ecoleRecrutement = null;


    public function __construct()
    {
        $this->depart = new ArrayCollection();
        $this->santes = new ArrayCollection();
        $this->dossierEleves = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this-> fullname ?? '';
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getStatutFinance(): ?string
    {
        return $this->statutFinance;
    }

    public function setStatutFinance(string $statutFinance): static
    {
        $this->statutFinance = $statutFinance;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateExtrait(): ?\DateTimeInterface
    {
        return $this->dateExtrait;
    }

    public function setDateExtrait(\DateTimeInterface $dateExtrait): static
    {
        $this->dateExtrait = $dateExtrait;

        return $this;
    }

    public function getNumExtrait(): ?string
    {
        return $this->numExtrait;
    }

    public function setNumExtrait(string $numExtrait): static
    {
        $this->numExtrait = $numExtrait;

        return $this;
    }

    public function isAdmis(): ?bool
    {
        return $this->isAdmis;
    }

    public function setIsAdmis(bool $isAdmis): static
    {
        $this->isAdmis = $isAdmis;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(bool $isActif): static
    {
        $this->isActif = $isActif;

        return $this;
    }

    public function isAllowed(): ?bool
    {
        return $this->isAllowed;
    }

    public function setIsAllowed(bool $isAllowed): static
    {
        $this->isAllowed = $isAllowed;

        return $this;
    }

    public function isHandicap(): ?bool
    {
        return $this->isHandicap;
    }

    public function setIsHandicap(bool $isHandicap): static
    {
        $this->isHandicap = $isHandicap;

        return $this;
    }

    public function getNatureHandicape(): ?string
    {
        return $this->natureHandicape;
    }

    public function setNatureHandicape(?string $natureHandicape): static
    {
        $this->natureHandicape = $natureHandicape;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getDateRecrutement(): ?\DateTimeInterface
    {
        return $this->dateRecrutement;
    }

    public function setDateRecrutement(\DateTimeInterface $dateRecrutement): static
    {
        $this->dateRecrutement = $dateRecrutement;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): static
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getNom(): ?Noms
    {
        return $this->nom;
    }

    public function setNom(?Noms $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?Prenoms
    {
        return $this->prenom;
    }

    public function setPrenom(?Prenoms $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLieuNaissance(): ?LieuNaissances
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?LieuNaissances $lieuNaissance): static
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getClasse(): ?Classes
    {
        return $this->classe;
    }

    public function setClasse(?Classes $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getDepartement(): ?Departements
    {
        return $this->departement;
    }

    public function setDepartement(?Departements $departement): static
    {
        $this->departement = $departement;

        return $this;
    }

    public function getScolarite1(): ?Scolarites1
    {
        return $this->scolarite1;
    }

    public function setScolarite1(?Scolarites1 $scolarite1): static
    {
        $this->scolarite1 = $scolarite1;

        return $this;
    }

    public function getScolarite2(): ?Scolarites2
    {
        return $this->scolarite2;
    }

    public function setScolarite2(?Scolarites2 $scolarite2): static
    {
        $this->scolarite2 = $scolarite2;

        return $this;
    }

    public function getRedoublement1(): ?Redoublements1
    {
        return $this->redoublement1;
    }

    public function setRedoublement1(?Redoublements1 $redoublement1): static
    {
        $this->redoublement1 = $redoublement1;

        return $this;
    }

    public function getRedoublement2(): ?Redoublements2
    {
        return $this->redoublement2;
    }

    public function setRedoublement2(?Redoublements2 $redoublement2): static
    {
        $this->redoublement2 = $redoublement2;

        return $this;
    }

    public function getRedoublement3(): ?Redoublements3
    {
        return $this->redoublement3;
    }

    public function setRedoublement3(?Redoublements3 $redoublement3): static
    {
        $this->redoublement3 = $redoublement3;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getParent(): ?Parents
    {
        return $this->parent;
    }

    public function setParent(?Parents $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, Departs>
     */
    public function getDepart(): Collection
    {
        return $this->depart;
    }

    public function addDepart(Departs $depart): static
    {
        if (!$this->depart->contains($depart)) {
            $this->depart->add($depart);
            $depart->setEleves($this);
        }

        return $this;
    }

    public function removeDepart(Departs $depart): static
    {
        if ($this->depart->removeElement($depart)) {
            // set the owning side to null (unless already changed)
            if ($depart->getEleves() === $this) {
                $depart->setEleves(null);
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
        // unset the owning side of the relation if necessary
        if ($fraisScolarites === null && $this->fraisScolarites !== null) {
            $this->fraisScolarites->setEleves(null);
        }

        // set the owning side of the relation if necessary
        if ($fraisScolarites !== null && $fraisScolarites->getEleves() !== $this) {
            $fraisScolarites->setEleves($this);
        }

        $this->fraisScolarites = $fraisScolarites;

        return $this;
    }

    /**
     * @return Collection<int, Santes>
     */
    public function getSantes(): Collection
    {
        return $this->santes;
    }

    public function addSante(Santes $sante): static
    {
        if (!$this->santes->contains($sante)) {
            $this->santes->add($sante);
            $sante->setEleve($this);
        }

        return $this;
    }

    public function removeSante(Santes $sante): static
    {
        if ($this->santes->removeElement($sante)) {
            // set the owning side to null (unless already changed)
            if ($sante->getEleve() === $this) {
                $sante->setEleve(null);
            }
        }

        return $this;
    }

    public function getStatuts(): ?Statuts
    {
        return $this->statuts;
    }

    public function setStatuts(?Statuts $statuts): static
    {
        $this->statuts = $statuts;

        return $this;
    }

    /**
     * @return Collection<int, DossierEleves>
     */
    public function getDossierEleves(): Collection
    {
        return $this->dossierEleves;
    }

    public function addDossierElefe(DossierEleves $dossierElefe): static
    {
        if (!$this->dossierEleves->contains($dossierElefe)) {
            $this->dossierEleves->add($dossierElefe);
            $dossierElefe->setEleves($this);
        }

        return $this;
    }

    public function removeDossierElefe(DossierEleves $dossierElefe): static
    {
        if ($this->dossierEleves->removeElement($dossierElefe)) {
            // set the owning side to null (unless already changed)
            if ($dossierElefe->getEleves() === $this) {
                $dossierElefe->setEleves(null);
            }
        }

        return $this;
    }

    public function getEcoleAnDernier(): ?EcoleProvenances
    {
        return $this->ecoleAnDernier;
    }

    public function setEcoleAnDernier(?EcoleProvenances $ecoleAnDernier): static
    {
        $this->ecoleAnDernier = $ecoleAnDernier;

        return $this;
    }

    public function getEcoleRecrutement(): ?EcoleProvenances
    {
        return $this->ecoleRecrutement;
    }

    public function setEcoleRecrutement(?EcoleProvenances $ecoleRecrutement): static
    {
        $this->ecoleRecrutement = $ecoleRecrutement;

        return $this;
    }


}

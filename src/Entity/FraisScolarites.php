<?php

namespace App\Entity;

use App\Entity\Caisses;
use App\Entity\FraisScolaires;
use Doctrine\DBAL\Types\Types;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\FraisScolaritesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FraisScolaritesRepository::class)]
class FraisScolarites
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fraisScolarites', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?FraisTypes $fraisTypes = null;

    /**
     * @var Collection<int, FraisScolaires>
     */
    #[ORM\ManyToMany(targetEntity: FraisScolaires::class, mappedBy: 'fraisScolarites')]
    private Collection $fraisScolaires;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $montant = null;

    #[ORM\OneToOne(inversedBy: 'fraisScolarites', cascade: ['persist', 'remove'], fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Eleves $eleves = null;

    #[ORM\ManyToOne(inversedBy: 'fraisScolarites', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?AnneeScolaires $anneeScolaires = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $arrieres = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $inscription = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $carnet = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $transfert = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $septembre = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $octobre = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $novembre = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $decembre = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $janvier = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $fevrier = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $mars = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $avril = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $mai = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $juin = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $autre = null;

    /**
     * @var Collection<int, Caisses>
     */
    #[ORM\OneToMany(targetEntity: Caisses::class, mappedBy: 'fraisScolarites')]
    private Collection $caisses;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceArrieres = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceInscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceCarnet = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceTransfert = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceSeptembre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceOctobre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceNovembre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceDecembre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceJanvier = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceFevrier = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceMars = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceAvril = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceMai = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceJuin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $echeanceAutre = null;

    public function __construct()
    {
        $this->fraisScolaires = new ArrayCollection();
        $this->caisses = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->fraisTypes ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $fraisScolaire->addFraisScolarite($this);
        }

        return $this;
    }

    public function removeFraisScolaire(FraisScolaires $fraisScolaire): static
    {
        if ($this->fraisScolaires->removeElement($fraisScolaire)) {
            $fraisScolaire->removeFraisScolarite($this);
        }

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

    public function getEleves(): ?Eleves
    {
        return $this->eleves;
    }

    public function setEleves(?Eleves $eleves): static
    {
        $this->eleves = $eleves;

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

    public function getArrieres(): ?int
    {
        return $this->arrieres;
    }

    public function setArrieres(int $arrieres): static
    {
        $this->arrieres = $arrieres;

        return $this;
    }

    public function getInscription(): ?int
    {
        return $this->inscription;
    }

    public function setInscription(int $inscription): static
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getCarnet(): ?int
    {
        return $this->carnet;
    }

    public function setCarnet(int $carnet): static
    {
        $this->carnet = $carnet;

        return $this;
    }

    public function getTransfert(): ?int
    {
        return $this->transfert;
    }

    public function setTransfert(int $transfert): static
    {
        $this->transfert = $transfert;

        return $this;
    }

    public function getSeptembre(): ?int
    {
        return $this->septembre;
    }

    public function setSeptembre(int $septembre): static
    {
        $this->septembre = $septembre;

        return $this;
    }

    public function getOctobre(): ?int
    {
        return $this->octobre;
    }

    public function setOctobre(int $octobre): static
    {
        $this->octobre = $octobre;

        return $this;
    }

    public function getNovembre(): ?int
    {
        return $this->novembre;
    }

    public function setNovembre(int $novembre): static
    {
        $this->novembre = $novembre;

        return $this;
    }

    public function getDecembre(): ?int
    {
        return $this->decembre;
    }

    public function setDecembre(int $decembre): static
    {
        $this->decembre = $decembre;

        return $this;
    }

    public function getJanvier(): ?int
    {
        return $this->janvier;
    }

    public function setJanvier(int $janvier): static
    {
        $this->janvier = $janvier;

        return $this;
    }

    public function getFevrier(): ?int
    {
        return $this->fevrier;
    }

    public function setFevrier(int $fevrier): static
    {
        $this->fevrier = $fevrier;

        return $this;
    }

    public function getMars(): ?int
    {
        return $this->mars;
    }

    public function setMars(int $mars): static
    {
        $this->mars = $mars;

        return $this;
    }

    public function getAvril(): ?int
    {
        return $this->avril;
    }

    public function setAvril(int $avril): static
    {
        $this->avril = $avril;

        return $this;
    }

    public function getMai(): ?int
    {
        return $this->mai;
    }

    public function setMai(int $mai): static
    {
        $this->mai = $mai;

        return $this;
    }

    public function getJuin(): ?int
    {
        return $this->juin;
    }

    public function setJuin(int $juin): static
    {
        $this->juin = $juin;

        return $this;
    }

    public function getAutre(): ?int
    {
        return $this->autre;
    }

    public function setAutre(int $autre): static
    {
        $this->autre = $autre;

        return $this;
    }

    /**
     * @return Collection<int, Caisses>
     */
    public function getCaisses(): Collection
    {
        return $this->caisses;
    }

    public function addCaiss(Caisses $caiss): static
    {
        if (!$this->caisses->contains($caiss)) {
            $this->caisses->add($caiss);
            $caiss->setFraisScolarites($this);
        }

        return $this;
    }

    public function removeCaiss(Caisses $caiss): static
    {
        if ($this->caisses->removeElement($caiss)) {
            // set the owning side to null (unless already changed)
            if ($caiss->getFraisScolarites() === $this) {
                $caiss->setFraisScolarites(null);
            }
        }

        return $this;
    }

    public function getEcheanceArrieres(): ?\DateTimeInterface
    {
        return $this->echeanceArrieres;
    }

    public function setEcheanceArrieres(?\DateTimeInterface $echeanceArrieres): static
    {
        $this->echeanceArrieres = $echeanceArrieres;

        return $this;
    }

    public function getEcheanceInscription(): ?\DateTimeInterface
    {
        return $this->echeanceInscription;
    }

    public function setEcheanceInscription(?\DateTimeInterface $echeanceInscription): static
    {
        $this->echeanceInscription = $echeanceInscription;

        return $this;
    }

    public function getEcheanceCarnet(): ?\DateTimeInterface
    {
        return $this->echeanceCarnet;
    }

    public function setEcheanceCarnet(?\DateTimeInterface $echeanceCarnet): static
    {
        $this->echeanceCarnet = $echeanceCarnet;

        return $this;
    }

    public function getEcheanceTransfert(): ?\DateTimeInterface
    {
        return $this->echeanceTransfert;
    }

    public function setEcheanceTransfert(?\DateTimeInterface $echeanceTransfert): static
    {
        $this->echeanceTransfert = $echeanceTransfert;

        return $this;
    }

    public function getEcheanceSeptembre(): ?\DateTimeInterface
    {
        return $this->echeanceSeptembre;
    }

    public function setEcheanceSeptembre(?\DateTimeInterface $echeanceSeptembre): static
    {
        $this->echeanceSeptembre = $echeanceSeptembre;

        return $this;
    }

    public function getEcheanceOctobre(): ?\DateTimeInterface
    {
        return $this->echeanceOctobre;
    }

    public function setEcheanceOctobre(?\DateTimeInterface $echeanceOctobre): static
    {
        $this->echeanceOctobre = $echeanceOctobre;

        return $this;
    }

    public function getEcheanceNovembre(): ?\DateTimeInterface
    {
        return $this->echeanceNovembre;
    }

    public function setEcheanceNovembre(?\DateTimeInterface $echeanceNovembre): static
    {
        $this->echeanceNovembre = $echeanceNovembre;

        return $this;
    }

    public function getEcheanceDecembre(): ?\DateTimeInterface
    {
        return $this->echeanceDecembre;
    }

    public function setEcheanceDecembre(?\DateTimeInterface $echeanceDecembre): static
    {
        $this->echeanceDecembre = $echeanceDecembre;

        return $this;
    }

    public function getEcheanceJanvier(): ?\DateTimeInterface
    {
        return $this->echeanceJanvier;
    }

    public function setEcheanceJanvier(?\DateTimeInterface $echeanceJanvier): static
    {
        $this->echeanceJanvier = $echeanceJanvier;

        return $this;
    }

    public function getEcheanceFevrier(): ?\DateTimeInterface
    {
        return $this->echeanceFevrier;
    }

    public function setEcheanceFevrier(?\DateTimeInterface $echeanceFevrier): static
    {
        $this->echeanceFevrier = $echeanceFevrier;

        return $this;
    }

    public function getEcheanceMars(): ?\DateTimeInterface
    {
        return $this->echeanceMars;
    }

    public function setEcheanceMars(?\DateTimeInterface $echeanceMars): static
    {
        $this->echeanceMars = $echeanceMars;

        return $this;
    }

    public function getEcheanceAvril(): ?\DateTimeInterface
    {
        return $this->echeanceAvril;
    }

    public function setEcheanceAvril(?\DateTimeInterface $echeanceAvril): static
    {
        $this->echeanceAvril = $echeanceAvril;

        return $this;
    }

    public function getEcheanceMai(): ?\DateTimeInterface
    {
        return $this->echeanceMai;
    }

    public function setEcheanceMai(?\DateTimeInterface $echeanceMai): static
    {
        $this->echeanceMai = $echeanceMai;

        return $this;
    }

    public function getEcheanceJuin(): ?\DateTimeInterface
    {
        return $this->echeanceJuin;
    }

    public function setEcheanceJuin(?\DateTimeInterface $echeanceJuin): static
    {
        $this->echeanceJuin = $echeanceJuin;

        return $this;
    }

    public function getEcheanceAutre(): ?\DateTimeInterface
    {
        return $this->echeanceAutre;
    }

    public function setEcheanceAutre(?\DateTimeInterface $echeanceAutre): static
    {
        $this->echeanceAutre = $echeanceAutre;

        return $this;
    }
}

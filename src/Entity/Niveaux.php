<?php

namespace App\Entity;

use App\Entity\Classes;
use App\Entity\Statuts;
use App\Entity\FraisTypes;
use App\Entity\Scolarites1;
use App\Entity\Scolarites2;
use App\Entity\Redoublements1;
use App\Entity\Redoublements2;
use App\Entity\Redoublements3;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\NiveauxRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NiveauxRepository::class)]
class Niveaux
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 75, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'niveauxes', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Cycles $cycle = null;

    /**
     * @var Collection<int, Classes>
     */
    #[ORM\OneToMany(targetEntity: Classes::class, mappedBy: 'niveau')]
    private Collection $classes;

    /**
     * @var Collection<int, FraisTypes>
     */
    #[ORM\OneToMany(targetEntity: FraisTypes::class, mappedBy: 'niveau')]
    private Collection $fraisTypes;

    /**
     * @var Collection<int, Redoublements1>
     */
    #[ORM\OneToMany(targetEntity: Redoublements1::class, mappedBy: 'niveau')]
    private Collection $redoublements1s;

    /**
     * @var Collection<int, Redoublements2>
     */
    #[ORM\OneToMany(targetEntity: Redoublements2::class, mappedBy: 'niveau')]
    private Collection $redoublements2s;

    /**
     * @var Collection<int, Redoublements3>
     */
    #[ORM\OneToMany(targetEntity: Redoublements3::class, mappedBy: 'niveau')]
    private Collection $redoublements3s;

    /**
     * @var Collection<int, Scolarites1>
     */
    #[ORM\OneToMany(targetEntity: Scolarites1::class, mappedBy: 'niveau')]
    private Collection $scolarites1s;

    /**
     * @var Collection<int, Scolarites2>
     */
    #[ORM\OneToMany(targetEntity: Scolarites2::class, mappedBy: 'niveau')]
    private Collection $scolarites2s;

    /**
     * @var Collection<int, Statuts>
     */
    #[ORM\ManyToMany(targetEntity: Statuts::class, mappedBy: 'niveaux')]
    private Collection $statuts;

    #[ORM\Column]
    private ?int $capacite = 0;

    #[ORM\Column]
    private ?int $effectif = 0;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->fraisTypes = new ArrayCollection();
        $this->redoublements1s = new ArrayCollection();
        $this->redoublements2s = new ArrayCollection();
        $this->redoublements3s = new ArrayCollection();
        $this->scolarites1s = new ArrayCollection();
        $this->scolarites2s = new ArrayCollection();
        $this->statuts = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this-> designation ?? '';
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

    public function getCycle(): ?Cycles
    {
        return $this->cycle;
    }

    public function setCycle(?Cycles $cycle): static
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classes $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setNiveau($this);
        }

        return $this;
    }

    public function removeClass(Classes $class): static
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getNiveau() === $this) {
                $class->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FraisTypes>
     */
    public function getFraisTypes(): Collection
    {
        return $this->fraisTypes;
    }

    public function addFraisType(FraisTypes $fraisType): static
    {
        if (!$this->fraisTypes->contains($fraisType)) {
            $this->fraisTypes->add($fraisType);
            $fraisType->setNiveau($this);
        }

        return $this;
    }

    public function removeFraisType(FraisTypes $fraisType): static
    {
        if ($this->fraisTypes->removeElement($fraisType)) {
            // set the owning side to null (unless already changed)
            if ($fraisType->getNiveau() === $this) {
                $fraisType->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Redoublements1>
     */
    public function getRedoublements1s(): Collection
    {
        return $this->redoublements1s;
    }

    public function addRedoublements1(Redoublements1 $redoublements1): static
    {
        if (!$this->redoublements1s->contains($redoublements1)) {
            $this->redoublements1s->add($redoublements1);
            $redoublements1->setNiveau($this);
        }

        return $this;
    }

    public function removeRedoublements1(Redoublements1 $redoublements1): static
    {
        if ($this->redoublements1s->removeElement($redoublements1)) {
            // set the owning side to null (unless already changed)
            if ($redoublements1->getNiveau() === $this) {
                $redoublements1->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Redoublements2>
     */
    public function getRedoublements2s(): Collection
    {
        return $this->redoublements2s;
    }

    public function addRedoublements2(Redoublements2 $redoublements2): static
    {
        if (!$this->redoublements2s->contains($redoublements2)) {
            $this->redoublements2s->add($redoublements2);
            $redoublements2->setNiveau($this);
        }

        return $this;
    }

    public function removeRedoublements2(Redoublements2 $redoublements2): static
    {
        if ($this->redoublements2s->removeElement($redoublements2)) {
            // set the owning side to null (unless already changed)
            if ($redoublements2->getNiveau() === $this) {
                $redoublements2->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Redoublements3>
     */
    public function getRedoublements3s(): Collection
    {
        return $this->redoublements3s;
    }

    public function addRedoublements3(Redoublements3 $redoublements3): static
    {
        if (!$this->redoublements3s->contains($redoublements3)) {
            $this->redoublements3s->add($redoublements3);
            $redoublements3->setNiveau($this);
        }

        return $this;
    }

    public function removeRedoublements3(Redoublements3 $redoublements3): static
    {
        if ($this->redoublements3s->removeElement($redoublements3)) {
            // set the owning side to null (unless already changed)
            if ($redoublements3->getNiveau() === $this) {
                $redoublements3->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Scolarites1>
     */
    public function getScolarites1s(): Collection
    {
        return $this->scolarites1s;
    }

    public function addScolarites1(Scolarites1 $scolarites1): static
    {
        if (!$this->scolarites1s->contains($scolarites1)) {
            $this->scolarites1s->add($scolarites1);
            $scolarites1->setNiveau($this);
        }

        return $this;
    }

    public function removeScolarites1(Scolarites1 $scolarites1): static
    {
        if ($this->scolarites1s->removeElement($scolarites1)) {
            // set the owning side to null (unless already changed)
            if ($scolarites1->getNiveau() === $this) {
                $scolarites1->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Scolarites2>
     */
    public function getScolarites2s(): Collection
    {
        return $this->scolarites2s;
    }

    public function addScolarites2(Scolarites2 $scolarites2): static
    {
        if (!$this->scolarites2s->contains($scolarites2)) {
            $this->scolarites2s->add($scolarites2);
            $scolarites2->setNiveau($this);
        }

        return $this;
    }

    public function removeScolarites2(Scolarites2 $scolarites2): static
    {
        if ($this->scolarites2s->removeElement($scolarites2)) {
            // set the owning side to null (unless already changed)
            if ($scolarites2->getNiveau() === $this) {
                $scolarites2->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Statuts>
     */
    public function getStatuts(): Collection
    {
        return $this->statuts;
    }

    public function addStatut(Statuts $statut): static
    {
        if (!$this->statuts->contains($statut)) {
            $this->statuts->add($statut);
            $statut->addNiveau($this);
        }

        return $this;
    }

    public function removeStatut(Statuts $statut): static
    {
        if ($this->statuts->removeElement($statut)) {
            $statut->removeNiveau($this);
        }

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getEffectif(): ?int
    {
        return $this->effectif;
    }

    public function setEffectif(int $effectif): static
    {
        $this->effectif = $effectif;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Entity\Parents;
use App\Entity\Telephones1;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PeresRepository;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PeresRepository::class)]
class Peres
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Parents>
     */
    #[ORM\OneToMany(targetEntity: Parents::class, mappedBy: 'pere')]
    private Collection $parents;

    #[ORM\ManyToOne(inversedBy: 'peres', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Noms $nom = null;

    #[ORM\ManyToOne(inversedBy: 'peres', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Prenoms $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'peres', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Professions $profession = null;

    #[ORM\OneToOne(inversedBy: 'peres', cascade: ['persist', 'remove'], fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Telephones1 $telephone1 = null;

    #[ORM\OneToOne(inversedBy: 'peres', cascade: ['persist', 'remove'], fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: true, referencedColumnName: 'id',)]
    private ?Telephones2 $telephone2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fullname = null;

    #[ORM\OneToOne(inversedBy: 'peres', cascade: ['persist', 'remove'])]
    private ?Ninas $nina = null;

    public function __construct()
    {
        $this->parents = new ArrayCollection();
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
     * @return Collection<int, Parents>
     */
    public function getParents(): Collection
    {
        return $this->parents;
    }

    public function addParent(Parents $parent): static
    {
        if (!$this->parents->contains($parent)) {
            $this->parents->add($parent);
            $parent->setPere($this);
        }

        return $this;
    }

    public function removeParent(Parents $parent): static
    {
        if ($this->parents->removeElement($parent)) {
            // set the owning side to null (unless already changed)
            if ($parent->getPere() === $this) {
                $parent->setPere(null);
            }
        }

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

    public function getProfession(): ?Professions
    {
        return $this->profession;
    }

    public function setProfession(?Professions $profession): static
    {
        $this->profession = $profession;

        return $this;
    }

    public function getTelephone1(): ?Telephones1
    {
        return $this->telephone1;
    }

    public function setTelephone1(Telephones1 $telephone1): static
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    public function getTelephone2(): ?Telephones2
    {
        return $this->telephone2;
    }

    public function setTelephone2(?Telephones2 $telephone2): static
    {
        $this->telephone2 = $telephone2;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): static
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getNina(): ?Ninas
    {
        return $this->nina;
    }

    public function setNina(?Ninas $nina): static
    {
        $this->nina = $nina;

        return $this;
    }
}

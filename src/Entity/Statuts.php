<?php

namespace App\Entity;

use App\Entity\Eleves;
use App\Entity\Niveaux;
use App\Entity\FraisTypes;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\StatutsRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StatutsRepository::class)]
class Statuts
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, FraisTypes>
     */
    #[ORM\OneToMany(targetEntity: FraisTypes::class, mappedBy: 'statut')]
    private Collection $fraisTypes;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 50, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $designation = null;

    /**
     * @var Collection<int, Eleves>
     */
    #[ORM\OneToMany(targetEntity: Eleves::class, mappedBy: 'statuts')]
    private Collection $eleves;

    /**
     * @var Collection<int, Niveaux>
     */
    #[ORM\ManyToMany(targetEntity: Niveaux::class, inversedBy: 'statuts', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private Collection $niveaux;

    public function __construct()
    {
        $this->fraisTypes = new ArrayCollection();
        $this->eleves = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this-> designation ?? '';
    }


    public function getId(): ?int
    {
        return $this->id;
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
            $fraisType->setStatut($this);
        }

        return $this;
    }

    public function removeFraisType(FraisTypes $fraisType): static
    {
        if ($this->fraisTypes->removeElement($fraisType)) {
            // set the owning side to null (unless already changed)
            if ($fraisType->getStatut() === $this) {
                $fraisType->setStatut(null);
            }
        }

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

    /**
     * @return Collection<int, Eleves>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleves $elefe): static
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves->add($elefe);
            $elefe->setStatuts($this);
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getStatuts() === $this) {
                $elefe->setStatuts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Niveaux>
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveaux $niveau): static
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux->add($niveau);
        }

        return $this;
    }

    public function removeNiveau(Niveaux $niveau): static
    {
        $this->niveaux->removeElement($niveau);

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\ClassesRepository;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
#[ORM\Table(name: "classes", indexes: [
    new ORM\Index(name: "idx_classes_designation", columns: ["designation"]),
    new ORM\Index(name: "idx_classes_niveau", columns: ["niveau_id"]),
    new ORM\Index(name: "idx_classes_disponibilite", columns: ["disponibilite"])],
    options: ["CHECK" => "disponibilite >= capacite - effectif"]
)]

class Classes
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
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $designation = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $capacite = 0;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $effectif = 0;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    private ?int $disponibilite = 0;

    #[ORM\ManyToOne(inversedBy: 'classes', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]

    private ?Niveaux $niveau = null;

    /**
     * @var Collection<int, Eleves>
     */
    #[ORM\OneToMany(targetEntity: Eleves::class, mappedBy: 'classe')]
    private Collection $eleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this-> designation ?? '';
    }

    #[Assert\Callback]
    public function validateDisponibilite(ExecutionContextInterface $context): void
    {
        if ($this->effectif > $this->capacite) {
            $context->buildViolation("L'effectif ne peut pas dépasser la capacité de la classe.")
                ->atPath('effectif')
                ->addViolation();
        }

        if ($this->disponibilite !== max(0, $this->capacite - $this->effectif)) {
            $context->buildViolation("La disponibilité doit être égale à la capacité moins l'effectif.")
                ->atPath('disponibilite')
                ->addViolation();
        }
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
        $this->updateDisponibilite();
        return $this;
    }

    public function getDisponibilite(): ?int
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(int $disponibilite): static
    {
        $this->disponibilite = $disponibilite;
        return $this;
    }

    public function getNiveau(): ?Niveaux
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveaux $niveau): static
    {
        $this->niveau = $niveau;

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
            $elefe->setClasse($this);

            // Mettre à jour l'effectif et la disponibilité
            $this->effectif++;
            $this->updateDisponibilite();
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            if ($elefe->getClasse() === $this) {
                $elefe->setClasse(null);
            }

            // Mettre à jour l'effectif et la disponibilité
            $this->effectif--;
            $this->updateDisponibilite();
        }

        return $this;
    }

    private function updateDisponibilite(): void
    {
        $this->disponibilite = max(0, $this->capacite - $this->effectif);
    }
}

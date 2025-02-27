<?php

namespace App\Entity;

use App\Entity\Meres;
use App\Entity\Peres;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Repository\ProfessionsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfessionsRepository::class)]
class Professions
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Meres>
     */
    #[ORM\OneToMany(targetEntity: Meres::class, mappedBy: 'profession')]
    private Collection $meres;

    /**
     * @var Collection<int, Peres>
     */
    #[ORM\OneToMany(targetEntity: Peres::class, mappedBy: 'profession')]
    private Collection $peres;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $designation = null;

    public function __construct()
    {
        $this->meres = new ArrayCollection();
        $this->peres = new ArrayCollection();
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
     * @return Collection<int, Meres>
     */
    public function getMeres(): Collection
    {
        return $this->meres;
    }

    public function addMere(Meres $mere): static
    {
        if (!$this->meres->contains($mere)) {
            $this->meres->add($mere);
            $mere->setProfession($this);
        }

        return $this;
    }

    public function removeMere(Meres $mere): static
    {
        if ($this->meres->removeElement($mere)) {
            // set the owning side to null (unless already changed)
            if ($mere->getProfession() === $this) {
                $mere->setProfession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Peres>
     */
    public function getPeres(): Collection
    {
        return $this->peres;
    }

    public function addPere(Peres $pere): static
    {
        if (!$this->peres->contains($pere)) {
            $this->peres->add($pere);
            $pere->setProfession($this);
        }

        return $this;
    }

    public function removePere(Peres $pere): static
    {
        if ($this->peres->removeElement($pere)) {
            // set the owning side to null (unless already changed)
            if ($pere->getProfession() === $this) {
                $pere->setProfession(null);
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
}

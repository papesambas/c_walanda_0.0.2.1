<?php

namespace App\Entity;

use App\Entity\Eleves;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\Redoublements3Repository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: Redoublements3Repository::class)]
class Redoublements3
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Eleves>
     */
    #[ORM\OneToMany(targetEntity: Eleves::class, mappedBy: 'redoublement3')]
    private Collection $eleves;

    #[ORM\ManyToOne(inversedBy: 'redoublements3s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Niveaux $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements3s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Redoublements2 $redoublement2 = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements3s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Scolarites1 $scolarite1 = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements3s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Scolarites2 $scolarite2 = null;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $elefe->setRedoublement3($this);
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getRedoublement3() === $this) {
                $elefe->setRedoublement3(null);
            }
        }

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

    public function getRedoublement2(): ?Redoublements2
    {
        return $this->redoublement2;
    }

    public function setRedoublement2(?Redoublements2 $redoublement2): static
    {
        $this->redoublement2 = $redoublement2;

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
}

<?php

namespace App\Entity;

use App\Entity\Eleves;
use App\Entity\Redoublements3;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\Redoublements2Repository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: Redoublements2Repository::class)]
class Redoublements2
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Eleves>
     */
    #[ORM\OneToMany(targetEntity: Eleves::class, mappedBy: 'redoublement2')]
    private Collection $eleves;

    #[ORM\ManyToOne(inversedBy: 'redoublements2s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Niveaux $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements2s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Redoublements1 $redoublement1 = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements2s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Scolarites1 $scolarite1 = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements2s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Scolarites2 $scolarite2 = null;

    /**
     * @var Collection<int, Redoublements3>
     */
    #[ORM\OneToMany(targetEntity: Redoublements3::class, mappedBy: 'redoublement2')]
    private Collection $redoublements3s;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->redoublements3s = new ArrayCollection();
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
            $elefe->setRedoublement2($this);
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getRedoublement2() === $this) {
                $elefe->setRedoublement2(null);
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

    public function getRedoublement1(): ?Redoublements1
    {
        return $this->redoublement1;
    }

    public function setRedoublement1(?Redoublements1 $redoublement1): static
    {
        $this->redoublement1 = $redoublement1;

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
            $redoublements3->setRedoublement2($this);
        }

        return $this;
    }

    public function removeRedoublements3(Redoublements3 $redoublements3): static
    {
        if ($this->redoublements3s->removeElement($redoublements3)) {
            // set the owning side to null (unless already changed)
            if ($redoublements3->getRedoublement2() === $this) {
                $redoublements3->setRedoublement2(null);
            }
        }

        return $this;
    }
}

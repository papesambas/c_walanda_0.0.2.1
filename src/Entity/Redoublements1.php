<?php

namespace App\Entity;

use App\Entity\Eleves;
use App\Entity\Redoublements2;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use App\Repository\Redoublements1Repository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: Redoublements1Repository::class)]
class Redoublements1
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Eleves>
     */
    #[ORM\OneToMany(targetEntity: Eleves::class, mappedBy: 'redoublement1')]
    private Collection $eleves;

    #[ORM\ManyToOne(inversedBy: 'redoublements1s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Niveaux $niveau = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements1s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Scolarites1 $scolarite1 = null;

    #[ORM\ManyToOne(inversedBy: 'redoublements1s', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: false,referencedColumnName: 'id',)]
    private ?Scolarites2 $scolarite2 = null;

    /**
     * @var Collection<int, Redoublements2>
     */
    #[ORM\OneToMany(targetEntity: Redoublements2::class, mappedBy: 'redoublement1')]
    private Collection $redoublements2s;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->redoublements2s = new ArrayCollection();
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
            $elefe->setRedoublement1($this);
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getRedoublement1() === $this) {
                $elefe->setRedoublement1(null);
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
            $redoublements2->setRedoublement1($this);
        }

        return $this;
    }

    public function removeRedoublements2(Redoublements2 $redoublements2): static
    {
        if ($this->redoublements2s->removeElement($redoublements2)) {
            // set the owning side to null (unless already changed)
            if ($redoublements2->getRedoublement1() === $this) {
                $redoublements2->setRedoublement1(null);
            }
        }

        return $this;
    }
}

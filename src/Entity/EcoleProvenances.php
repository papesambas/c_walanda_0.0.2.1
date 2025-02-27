<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\EcoleProvenancesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EcoleProvenancesRepository::class)]
class EcoleProvenances
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $designation = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 150, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $adresse = null;

    #[ORM\Column(length: 23, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Eleves>
     */
    #[ORM\OneToMany(targetEntity: Eleves::class, mappedBy: 'ecoleAnDernier')]
    private Collection $elevesAnDernier;

    /**
     * @var Collection<int, Eleves>
     */
    #[ORM\OneToMany(targetEntity: Eleves::class, mappedBy: 'ecoleRecrutement')]
    private Collection $elevesRecrutes;

    public function __construct()
    {
        $this->elevesAnDernier = new ArrayCollection();
        $this->elevesRecrutes = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getElevesAnDernier(): Collection
    {
        return $this->elevesAnDernier;
    }

    public function addElevesAnDernier(Eleves $elevesAnDernier): static
    {
        if (!$this->elevesAnDernier->contains($elevesAnDernier)) {
            $this->elevesAnDernier->add($elevesAnDernier);
            $elevesAnDernier->setEcoleAnDernier($this);
        }

        return $this;
    }

    public function removeElevesAnDernier(Eleves $elevesAnDernier): static
    {
        if ($this->elevesAnDernier->removeElement($elevesAnDernier)) {
            // set the owning side to null (unless already changed)
            if ($elevesAnDernier->getEcoleAnDernier() === $this) {
                $elevesAnDernier->setEcoleAnDernier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getElevesRecrutes(): Collection
    {
        return $this->elevesRecrutes;
    }

    public function addElevesRecrute(Eleves $elevesRecrute): static
    {
        if (!$this->elevesRecrutes->contains($elevesRecrute)) {
            $this->elevesRecrutes->add($elevesRecrute);
            $elevesRecrute->setEcoleRecrutement($this);
        }

        return $this;
    }

    public function removeElevesRecrute(Eleves $elevesRecrute): static
    {
        if ($this->elevesRecrutes->removeElement($elevesRecrute)) {
            // set the owning side to null (unless already changed)
            if ($elevesRecrute->getEcoleRecrutement() === $this) {
                $elevesRecrute->setEcoleRecrutement(null);
            }
        }

        return $this;
    }


}

<?php

namespace App\Entity;

use App\Entity\Caisses;
use App\Entity\DetailsCaisses;
use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    use CreatedAtTrait;
    use SlugTrait;
    use EntityTrackingTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 180, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 75)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 75, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $nom = null;

    #[ORM\Column(length: 75)]
    #[Assert\NotBlank(message: "La désignation ne peut pas être vide.")]
    #[Assert\Length(max: 75, maxMessage: "La désignation ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'email ne peut pas être vide.")]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fullname = null;

    #[ORM\Column]
    private bool $isVerified = false;

    /**
     * @var Collection<int, Caisses>
     */
    #[ORM\OneToMany(targetEntity: Caisses::class, mappedBy: 'author')]
    private Collection $caisses;

    /**
     * @var Collection<int, DetailsCaisses>
     */
    #[ORM\OneToMany(targetEntity: DetailsCaisses::class, mappedBy: 'author')]
    private Collection $detailsCaisses;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Eleves $eleves = null;

    #[ORM\ManyToOne(inversedBy: 'user', fetch: "LAZY")]
    #[ORM\JoinColumn(nullable: true,referencedColumnName: 'id',)]
    private ?Etablissements $etablissements = null;

    public function __construct()
    {
        $this->caisses = new ArrayCollection();
        $this->detailsCaisses = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->username ?? 'Unknown';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): static
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

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
            $caiss->setAuthor($this);
        }

        return $this;
    }

    public function removeCaiss(Caisses $caiss): static
    {
        if ($this->caisses->removeElement($caiss)) {
            // set the owning side to null (unless already changed)
            if ($caiss->getAuthor() === $this) {
                $caiss->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetailsCaisses>
     */
    public function getDetailsCaisses(): Collection
    {
        return $this->detailsCaisses;
    }

    public function addDetailsCaiss(DetailsCaisses $detailsCaiss): static
    {
        if (!$this->detailsCaisses->contains($detailsCaiss)) {
            $this->detailsCaisses->add($detailsCaiss);
            $detailsCaiss->setAuthor($this);
        }

        return $this;
    }

    public function removeDetailsCaiss(DetailsCaisses $detailsCaiss): static
    {
        if ($this->detailsCaisses->removeElement($detailsCaiss)) {
            // set the owning side to null (unless already changed)
            if ($detailsCaiss->getAuthor() === $this) {
                $detailsCaiss->setAuthor(null);
            }
        }

        return $this;
    }

    public function getEleves(): ?Eleves
    {
        return $this->eleves;
    }

    public function setEleves(?Eleves $eleves): static
    {
        // unset the owning side of the relation if necessary
        if ($eleves === null && $this->eleves !== null) {
            $this->eleves->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($eleves !== null && $eleves->getUser() !== $this) {
            $eleves->setUser($this);
        }

        $this->eleves = $eleves;

        return $this;
    }

    public function getEtablissements(): ?Etablissements
    {
        return $this->etablissements;
    }

    public function setEtablissements(?Etablissements $etablissements): static
    {
        $this->etablissements = $etablissements;

        return $this;
    }
}

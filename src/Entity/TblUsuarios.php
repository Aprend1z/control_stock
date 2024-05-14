<?php

namespace App\Entity;

use App\Repository\TblUsuariosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: TblUsuariosRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
class TblUsuarios implements UserInterface, PasswordAuthenticatedUserInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 180)]
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

  /**
   * @var Collection<int, TblMovimientos>
   */
  #[ORM\OneToMany(targetEntity: TblMovimientos::class, mappedBy: 'usuario')]
  private Collection $movimientos;

  public function __construct($username = null, $password = null, $roles = null) 
  {
    $this->username = $username;
    $this->password = $password;
    $this->roles = ['ROLE_USER'];
    $this->movimientos = new ArrayCollection();
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
  public function getPassword(): string
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

  /**
   * @return Collection<int, TblMovimientos>
   */
  public function getMovimientos(): Collection
  {
    return $this->movimientos;
  }

  public function addMovimiento(TblMovimientos $movimiento): static
  {
    if (!$this->movimientos->contains($movimiento)) {
      $this->movimientos->add($movimiento);
      $movimiento->setUsuario($this);
    }

    return $this;
  }

  public function removeMovimiento(TblMovimientos $movimiento): static
  {
    if ($this->movimientos->removeElement($movimiento)) {
      // set the owning side to null (unless already changed)
      if ($movimiento->getUsuario() === $this) {
        $movimiento->setUsuario(null);
      }
    }

    return $this;
  }
}
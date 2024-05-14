<?php

namespace App\Entity;

use App\Repository\TblTipoMovimientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TblTipoMovimientoRepository::class)]
class TblTipoMovimiento
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 20)]
  private ?string $nombre = null;

  #[ORM\Column(length: 50)]
  private ?string $descripcion = null;

  /**
   * @var Collection<int, TblMovimientos>
   */
  #[ORM\OneToMany(targetEntity: TblMovimientos::class, mappedBy: 'tipomovimiento')]
  private Collection $movimiento;

  public function __construct($nombre = null, $descripcion = null)
  {
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
    $this->movimiento = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNombre(): ?string
  {
    return $this->nombre;
  }

  public function setNombre(string $nombre): static
  {
    $this->nombre = $nombre;

    return $this;
  }

  public function getDescripcion(): ?string
  {
    return $this->descripcion;
  }

  public function setDescripcion(string $descripcion): static
  {
    $this->descripcion = $descripcion;

    return $this;
  }

  /**
   * @return Collection<int, TblMovimientos>
   */
  public function getMovimiento(): Collection
  {
    return $this->movimiento;
  }

  public function addMovimiento(TblMovimientos $movimiento): static
  {
    if (!$this->movimiento->contains($movimiento)) {
      $this->movimiento->add($movimiento);
      $movimiento->setTipomovimiento($this);
    }

    return $this;
  }

  public function removeMovimiento(TblMovimientos $movimiento): static
  {
    if ($this->movimiento->removeElement($movimiento)) {
      // set the owning side to null (unless already changed)
      if ($movimiento->getTipomovimiento() === $this) {
        $movimiento->setTipomovimiento(null);
      }
    }

    return $this;
  }
}

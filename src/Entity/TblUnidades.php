<?php

namespace App\Entity;

use App\Repository\TblUnidadesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TblUnidadesRepository::class)]
class TblUnidades
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 5)]
  private ?string $nombre = null;

  #[ORM\Column(length: 30)]
  private ?string $descripcion = null;

  /**
   * @var Collection<int, TblProductos>
   */
  #[ORM\OneToMany(targetEntity: TblProductos::class, mappedBy: 'unidad')]
  private Collection $producto;

  public function __construct($nombre = null, $descripcion = null)
  {
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
    $this->producto = new ArrayCollection();
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
   * @return Collection<int, TblProductos>
   */
  public function getProducto(): Collection
  {
    return $this->producto;
  }

  public function addProducto(TblProductos $producto): static
  {
    if (!$this->producto->contains($producto)) {
      $this->producto->add($producto);
      $producto->setUnidad($this);
    }

    return $this;
  }

  public function removeProducto(TblProductos $producto): static
  {
    if ($this->producto->removeElement($producto)) {
      // set the owning side to null (unless already changed)
      if ($producto->getUnidad() === $this) {
        $producto->setUnidad(null);
      }
    }

    return $this;
  }
}

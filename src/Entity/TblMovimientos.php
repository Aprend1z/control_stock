<?php

namespace App\Entity;

use App\Repository\TblMovimientosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TblMovimientosRepository::class)]
class TblMovimientos
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private ?int $cantidad = null;

  #[ORM\Column(type: Types::DATETIME_MUTABLE)]
  private ?\DateTimeInterface $fechahora = null;

  #[ORM\ManyToOne(inversedBy: 'movimientos')]
  #[ORM\JoinColumn(nullable: false)]
  private ?TblUsuarios $usuario = null;

  #[ORM\ManyToOne(inversedBy: 'movimientos')]
  #[ORM\JoinColumn(nullable: false)]
  private ?TblProductos $producto = null;

  #[ORM\ManyToOne(inversedBy: 'movimiento')]
  #[ORM\JoinColumn(nullable: false)]
  private ?TblTipoMovimiento $tipomovimiento = null;

  public function __construct($tipomovimiento = null, $usuario = null, $producto = null, $cantidad = null, $fechahora = null)
  {
    $this->tipomovimiento = $tipomovimiento;
    $this->usuario = $usuario;
    $this->producto = $producto;
    $this->cantidad = $cantidad;
  }
  public function getId(): ?int
  {
    return $this->id;
  }

  public function getCantidad(): ?int
  {
    return $this->cantidad;
  }

  public function setCantidad(int $cantidad): static
  {
    $this->cantidad = $cantidad;

    return $this;
  }

  public function getFechahora(): ?\DateTimeInterface
  {
    return $this->fechahora;
  }

  public function setFechahora(\DateTimeInterface $fechahora): static
  {
    $this->fechahora = $fechahora;

    return $this;
  }

  public function getUsuario(): ?TblUsuarios
  {
    return $this->usuario;
  }

  public function setUsuario(?TblUsuarios $usuario): static
  {
    $this->usuario = $usuario;

    return $this;
  }

  public function getProducto(): ?TblProductos
  {
    return $this->producto;
  }

  public function setProducto(?TblProductos $producto): static
  {
    $this->producto = $producto;

    return $this;
  }

  public function getTipomovimiento(): ?TblTipoMovimiento
  {
    return $this->tipomovimiento;
  }

  public function setTipomovimiento(?TblTipoMovimiento $tipomovimiento): static
  {
    $this->tipomovimiento = $tipomovimiento;

    return $this;
  }
}

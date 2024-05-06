<?php

namespace App\Entity;

use App\Repository\TblProductosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TblProductosRepository::class)]
class TblProductos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column]
    private ?int $formato = null;

    /**
     * @var Collection<int, TblMovimientos>
     */
    #[ORM\OneToMany(targetEntity: TblMovimientos::class, mappedBy: 'producto')]
    private Collection $movimientos;

    #[ORM\ManyToOne(inversedBy: 'producto')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TblUnidades $unidad = null;

    public function __construct()
    {
        $this->movimientos = new ArrayCollection();
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

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFormato(): ?int
    {
        return $this->formato;
    }

    public function setFormato(int $formato): static
    {
        $this->formato = $formato;

        return $this;
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
            $movimiento->setProducto($this);
        }

        return $this;
    }

    public function removeMovimiento(TblMovimientos $movimiento): static
    {
        if ($this->movimientos->removeElement($movimiento)) {
            // set the owning side to null (unless already changed)
            if ($movimiento->getProducto() === $this) {
                $movimiento->setProducto(null);
            }
        }

        return $this;
    }

    public function getUnidad(): ?TblUnidades
    {
        return $this->unidad;
    }

    public function setUnidad(?TblUnidades $unidad): static
    {
        $this->unidad = $unidad;

        return $this;
    }
}

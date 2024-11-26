<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\VendibleInterface;
use App\Traits\Descuento;

abstract class Producto implements VendibleInterface {
    use Descuento;

    public const IVA = 0.21;

    public function __construct (
        private string $id = uniqid(),
        protected string $nombre,
        protected float $precio
        ) 
    {
    }

    abstract public function mostrarDescripcion(): void;

    public function calcularPrecioConIVA(): float {
        return $this->precio * (1 + self::IVA);
    }

    public function getId(): string {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getPrecio(): float {
        return $this->precio;
    }
    
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setPrecio(float $precio): void {        
        $this->precio = $precio;
    }
}
<?php

declare(strict_types=1);

namespace App\Models;

class Ropa extends Producto {
    private string $talla;

    public function __construct(string $nombre, float $precio, string $talla) {
        parent::__construct($nombre, $precio);
        $this->talla = $talla;
    }
    
    public function mostrarDescripcion():void{
        //implementar una descripción de la ropa
    }
}
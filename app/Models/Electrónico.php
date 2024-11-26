<?php

declare(strict_types=1);

namespace App\Models;

class Electrónico extends Producto {
    private string $modelo;

    public function __construct(string $nombre, float $precio, string $modelo) {
        parent::__construct($nombre, $precio);
        $this->modelo = $modelo;
    }
    
    public function mostrarDescripcion():void{
        //implementar una descripción del producto electrónico.
    }
}
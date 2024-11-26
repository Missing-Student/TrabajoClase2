<?php

declare(strict_types=1);

namespace App\Models;

class Electrónico extends Producto {

    public function __construct(
        protected string $nombre, 
        protected float $precio, 
        private string $modelo
        ) 
    {
        parent::__construct($nombre, $precio);
    }
    
    public function mostrarDescripcion():void{
        //implementar una descripción del producto electrónico.
    }
}
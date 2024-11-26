<?php

declare(strict_types=1);

namespace App\Models;

class Ropa extends Producto {

    public function __construct(
        protected string $nombre, 
        protected float $precio, 
        private string $talla
        ) 
    {
        parent::__construct($nombre, $precio);
    }
    
    public function mostrarDescripcion():void{
        //implementar una descripción de la ropa
    }
}
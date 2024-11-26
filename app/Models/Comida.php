<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;

class Comida extends Producto {

    public function __construct(
        protected string $nombre, 
        protected float $precio, 
        private DateTime $caducidad
        ) 
    {
        parent::__construct($nombre, $precio);
    }
    
    public function mostrarDescripcion():void{
        //implementar una descripción de la comida.
    }
}
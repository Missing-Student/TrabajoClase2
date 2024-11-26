<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;

class Comida extends Producto {
    private DateTime $caducidad;

    public function __construct(string $nombre, float $precio, DateTime $caducidad) {
        parent::__construct($nombre, $precio);
        $this->caducidad = $caducidad;
    }
    
    public function mostrarDescripcion():void{
        //implementar una descripción de la comida.
    }
}
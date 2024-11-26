<?php

declare(strict_types=1);

namespace App\Traits;

trait Descuento{
    public function aplicarDescuento(float $descuento): float{
        return $this->precio * (1 - $descuento / 100);
    }
}
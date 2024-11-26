<?php

declare(strict_types=1);

namespace App\Interfaces;

interface VendibleInterface{
    function calcularPrecioConIVA():float;
}
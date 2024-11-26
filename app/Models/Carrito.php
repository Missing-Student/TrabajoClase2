<?php

declare(strict_types=1);

namespace App\Models;

class Carrito {

    public function __construct(
        private array $productos = []
        )
    {
    }

    public function agregarProducto(Producto $producto):void {
        $this->productos[] = $producto;
    }

    public function elminarProducto(Producto $producto):void {
        $index = array_search($producto, $this->productos);
        if ($index !== false) {
            unset($this->productos[$index]);
        }
    }

    public function calcularTotal():float{
        $total = 0;
        foreach ($this->productos as $producto) {
            $total += $producto->calcularPrecioConIVA();
        }
        return $total;
    }

    public function vaciarCarrito():void{
        $this->productos = [];
    }

    public function mostrarCarrito():void{
        foreach ($this->productos as $producto) {
            echo $producto->getNombre() . ' - ' . $producto->getPrecio() . '€' . '<br>';
        }
    }
}
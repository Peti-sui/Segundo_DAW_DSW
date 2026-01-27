<?php

require_once 'Llavero.php';

abstract class Paquete
{
    protected Llavero $producto;
    protected int $cantidad;
    protected float $importeTotal;

    public function __construct(Llavero $producto, int $cantidad)
    {
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->importeTotal = $this->calcularImporte();
    }

    abstract protected function calcularImporte(): float;

    public function getImporteTotal(): float
    {
        return $this->importeTotal;
    }
}
?>
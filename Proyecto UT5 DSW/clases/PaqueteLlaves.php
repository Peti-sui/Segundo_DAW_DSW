<?php

require_once 'Paquete.php';

class PaqueteLlaves extends Paquete
{
    protected function calcularImporte(): float
    {
        return $this->producto->getPrecio() * $this->cantidad;
    }
}
?>
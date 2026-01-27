<?php

require_once 'Paquete.php';

class PaqueteBolso extends Paquete
{
    protected function calcularImporte(): float
    {
        return $this->producto->getPrecio();
    }
}
?>
<?php

require_once 'Paquete.php';

class PaqueteMochila extends Paquete
{
    protected function calcularImporte(): float
    {
        return ($this->producto->getPrecio() * $this->cantidad) * 2;
    }
}
?>
<?php
require_once 'Paquete.php';

class PaqueteMochila extends Paquete
{
    public function __construct(string $nombre, float $precio)
    {
        parent::__construct($nombre, $precio, 'mochila');
    }
    
    // Paquete de mochila: doble precio por cantidad (producto premium)
    public function calcularPrecio(int $cantidad): float
    {
        return ($this->precio * $cantidad) * 2;
    }
}
?>
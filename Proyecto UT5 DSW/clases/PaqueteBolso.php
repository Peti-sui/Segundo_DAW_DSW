<?php
require_once 'Paquete.php';

class PaqueteBolso extends Paquete
{
    public function __construct(string $nombre, float $precio)
    {
        parent::__construct($nombre, $precio, 'bolso');
    }
    
    // Paquete de bolso: precio fijo sin importar cantidad (oferta especial)
    public function calcularPrecio(int $cantidad): float
    {
        return $this->precio; // Solo paga el precio base, sin multiplicar
    }
}
?>
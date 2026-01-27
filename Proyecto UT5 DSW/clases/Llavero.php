<?php

require_once 'Producto.php';

class Llavero extends Producto
{
    private string $tipo;

    public function __construct(string $nombre, float $precio, string $tipo)
    {
        parent::__construct($nombre, $precio);
        $this->tipo = $tipo;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }
}
?>
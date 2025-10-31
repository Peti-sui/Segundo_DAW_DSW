<?php

class Contacto
{
    public $nombre;
    public $telefono;
    public $email;

    public function __construct($nombre, $telefono = '', $email = '')
    {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;

    }

    public function desdeArray()
    {
        return [$this->nombre, $this->telefono, $this->email];
    }

    public static function paraArray(array $array)
    {
        $nombre = isset($array[0]) ? $array[0] : '';
        $telefono = isset($array[1]) ? $array[1] : '';
        $email = isset($array[2]) ? $array[2] : '';

        return new Contacto($nombre, $telefono, $email);
    }
}

?>
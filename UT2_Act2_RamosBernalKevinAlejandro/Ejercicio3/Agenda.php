<?php

require_once 'Contacto.php';

class Agenda {

    private $fichero;
    private $contactos;

    public function __construct($ruta_fichero){
        $this->fichero = $ruta_fichero;
        $this->contactos = [];
        $this->cargar();
    }

    private function cargar(){
        
    }
}
?>
<?php

require_once 'Contacto.php';

class Agenda
{

    private $fichero;      /* ruta del fichero de almacenamiento */
    private $contactos;    /* array asociativo de objetos Contacto */

    /* Constructor: inicializa la ruta y carga los datos existentes */
    public function __construct($ruta_fichero)
    {
        $this->fichero = $ruta_fichero;
        $this->contactos = [];
        $this->cargar();
    }

    /* Carga los contactos desde el fichero CSV */
    private function cargar()
    {

        $this->contactos = [];

        if (!file_exists($this->fichero)) {
            /* si el fichero no existe se crea la carpeta y un fichero vacio */
            @mkdir(dirname($this->fichero), 0777, true);
            @touch($this->fichero);
            return;
        }

        if (($handle = fopen($this->fichero, 'r')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                /* cada linea del fichero se convierte en un objeto Contacto */
                $contacto = Contacto::paraArray($data);
                if ($contacto->nombre !== '') {
                    $this->contactos[$contacto->nombre] = $contacto;
                }
            }
            fclose($handle);
        }
    }

    /* Guarda todos los contactos en el fichero CSV */
    private function guardar()
    {
        if (($handle = fopen($this->fichero, 'w')) === false) {
            throw new Exception("No se pudo abrir el fichero para escribir");
        }

        if (!flock($handle, LOCK_EX)) {
            fclose($handle);
            throw new Exception("No se pudo bloquear el fichero para escribir");
        }

        /* se escriben todos los contactos en formato CSV */
        foreach ($this->contactos as $contacto) {
            fputcsv($handle, $contacto->desdeArray());
        }

        fflush($handle);
        flock($handle, LOCK_UN);
        fclose($handle);
    }

    /* Busca un contacto por su nombre y devuelve el objeto Contacto o null */
    public function buscarPorNombre($nombre)
    {
        return $this->contactos[$nombre] ?? null;
    }

    /* Busca si existe un contacto con el mismo email para evitar duplicados */
    public function buscarPorEmail($email)
    {
        foreach ($this->contactos as $c) {
            if ($c->email === $email && $email !== '')
                return $c;
        }
        return null;
    }

    /* Agrega un nuevo contacto si el nombre y email no estan duplicados */
    public function agregar(Contacto $contacto)
    {
        if ($contacto->nombre === '') {
            throw new Exception("nombre vacio");
        }

        if (isset($this->contactos[$contacto->nombre])) {
            throw new Exception("nombre ya existe");
        }

        /* se comprueba que el email no este en uso */
        if ($contacto->email !== '' && $this->buscarPorEmail($contacto->email) !== null) {
            throw new Exception("email ya existe");
        }

        $this->contactos[$contacto->nombre] = $contacto;
        $this->guardar();
    }

    /* Actualiza telefono y/o email de un contacto existente */
    public function actualizar($nombre, $telefono = null, $email = null)
    {
        if (!isset($this->contactos[$nombre])) {
            throw new Exception("nombre no existe");
        }

        /* comprueba si el email nuevo esta en otro contacto */
        if ($email !== null && $email !== '') {
            $otro = $this->buscarPorEmail($email);
            if ($otro !== null && $otro->nombre !== $nombre) {
                throw new Exception("email ya existe en otro contacto");
            }
            $this->contactos[$nombre]->email = $email;
        }

        if ($telefono !== null && $telefono !== '') {
            $this->contactos[$nombre]->telefono = $telefono;
        }

        $this->guardar();
    }

    /* Elimina un contacto existente por nombre */
    public function eliminar($nombre)
    {
        if (isset($this->contactos[$nombre])) {
            unset($this->contactos[$nombre]);
            $this->guardar();
        }
    }

    /* Devuelve la lista completa de contactos almacenados */
    public function listar()
    {
        return $this->contactos;
    }
}
?>
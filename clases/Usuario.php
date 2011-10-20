<?php

class Usuario {
    private $id, $nombre, $telefono, $zugriff;

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }


    public function getTelefono() {
        return $this->telefono;
    }

    public function getZugriff() {
        return $this->zugriff;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setZugriff($zugriff) {
        $this->zugriff = $zugriff;
    }

}
?>

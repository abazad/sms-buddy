<?php

include_once 'ConexionBd.php';
include_once 'Usuario.php';

class GestorPersistencia {

    public static function agregaUsuario($usuario) {
        $conexionBd = ConexionBd::getInstance();
        $consulta = 'INSERT INTO usuarios VALUES (' . $usuario->getId() . ', \'' . $usuario->getNombre() . '\', \'' . $usuario->getTelefono() . '\', \'' . base64_encode($usuario->getZugriff()) . '\')';
        $conexionBd->getEzSql()->query($consulta);
    }

    public static function buscaUsuarioId($idUsuario) {
        $conexionBd = ConexionBd::getInstance();
        $consulta = 'SELECT * FROM usuarios WHERE id=\'' . $idUsuario . '\'';
        $resultado = $conexionBd->getEzSql()->get_row($consulta);
        if (isset($resultado->id)) {
            $usuario = new Usuario();
            $usuario->setId($resultado->id);
            $usuario->setNombre($resultado->nombre);
            $usuario->setTelefono($resultado->telefono);
            $usuario->setZugriff(base64_decode($resultado->zugriff));
            return $usuario;
        }
        return null;
    }

    public static function buscaUsuarioTel($numTel) {
        $conexionBd = ConexionBd::getInstance();
        $consulta = 'SELECT * FROM usuarios WHERE telefono=\'' . $numTel . '\'';
        echo $consulta;
        $resultado = $conexionBd->getEzSql()->get_row($consulta);
        if (isset($resultado->id)) {
            $usuario = new Usuario();
            $usuario->setId($resultado->id);
            $usuario->setNombre($resultado->nombre);
            $usuario->setTelefono($resultado->telefono);
            $usuario->setZugriff(base64_decode($resultado->zugriff));
            return $usuario;
        }
        return null;
    }

}

?>

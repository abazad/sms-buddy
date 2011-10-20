<?php

include_once 'clases/Usuario.php';
session_start();
include_once 'config.php';

if (isset($_SESSION['usuarioActual'])) {
    $usuario = $_SESSION['usuarioActual'];
    if ($usuario->getZugriff() != null) {
        header('location: ' . URL_DISPATCHER . '?perfil');
        return;
    }
    header('location: ' . URL_BASE . 'registro.php');
    return;
} else {
    header('location: ' . URL_DISPATCHER . '?bienvenida');
    return;
}
?>

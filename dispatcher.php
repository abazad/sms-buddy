<?php

include_once 'clases/Usuario.php';
session_start();
include_once 'clases/GestorPersistencia.php';
include_once 'config.php';

if (isset($_GET['autentifica'])) {
    header('location: ' . URL_AUT_FB);
    return;
}
if (isset($_GET['perfil'])) {
    header('location: ' . URL_BASE . 'perfil.php');
    return;
}
if (isset($_GET['bienvenida'])) {
    header('location: ' . URL_BASE . 'bienvenida.php');
    return;
}
if (isset($_GET['aut'])) {
    header('location: ' . URL_BASE . 'aut.php');
    return;
}
if (isset($_GET['registra'])) {
    $usuario = $_SESSION['usuarioActual'];
    $telefono = $_POST['telefono'];
    $usuario->setTelefono($telefono);
    GestorPersistencia::agregaUsuario($usuario);
    header('location: ' . URL_DISPATCHER . '?perfil');
    return;
}
header('location: ' . URL_BASE);
?>

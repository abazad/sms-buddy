<?php

include_once 'clases/GestorPersistencia.php';
include_once 'clases/GestorFbApi.php';
$tel = $_POST['sender'];
$msj = $_POST['text'];
$usuario = GestorPersistencia::buscaUsuarioTel($tel);
if (isset($usuario)) {
    var_dump($usuario);
    GestorFbApi::publicaMensaje($usuario, $msj);
    return;
}
?>

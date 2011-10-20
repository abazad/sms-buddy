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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SMS Buddy</title>
        <link href="estilo.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php include 'config.php' ?>
        <form action="<?php echo URL_DISPATCHER . '?aut' ?>" method="POST">
            <h1>SMS Buddy</h1>
            <p>SMS Buddy es un servicio que te permite actualizar el estado de tu cuenta de Facebook por medio de mensajes de texto SMS.</p>
            <p><strong>¿Cómo funciona?</strong></p>
            <ol>
                <li>Primero debes autorizar nuestra aplicación de Facebook.</li>
                <li>Posteriormente debes darnos un número del cual podrás enviar los mensajes.</li>
                <li>Te daremos un número al que podrás enviar mensajes para actualizar tu muro.</li>
                <li>En cualquier momento puedes cambiar de número o eliminar la aplicación.</li>
            </ol>
            <p><button type="submit">Comenzar</button></p>
        </form>
    </body>
</html>
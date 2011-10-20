<?php
include_once 'clases/Usuario.php';
session_start();
include_once 'config.php';
if (!isset($_SESSION['usuarioActual'])) {
    header('location: ' . URL_DISPATCHER . '?bienvenida');
    return;
}
if($_SESSION['usuarioActual']->getTelefono() != null) {
    header('location: ' . URL_DISPATCHER . '?perfil');
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
        <form action="<?php echo URL_DISPATCHER . '?registra' ?>" method="POST">
            <h1>Hola, <?php echo $_SESSION['usuarioActual']->getNombre() ?></h1>
            <p>Para continuar por favor introduce el número de celular por medio del cual enviarás los mensajes para actualizar tu perfil. Tienes que introducirlo sin espacios y con el código de área .</p>
            <p>Ejemplo: <strong>5511255423</strong> es un número válido de la Ciudad de México.</p>
            <p>N&uacute;mero de tel&eacute;fono: <input type="text" name="telefono"/>
            </p>
            <p><button type="submit">Continuar</button></p>
        </form>
    </body>
</html>
<?php
include_once 'clases/Usuario.php';
session_start();
include_once 'config.php';
if (!isset($_SESSION['usuarioActual'])) {
    header('location: ' . URL_DISPATCHER . '?bienvenida');
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
        <form action="<?php echo URL_DISPATCHER . '?actualiza' ?>" method="POST">
            <h1>Hola, <?php echo $_SESSION['usuarioActual']->getNombre() ?></h1>
            <p>Puedes enviar tus actualizaciones al teléfono <?php echo NUMERO_APP ?>. Sólo pagarás el costo de un mensaje de texto común y corriente.</p>
            <p>N&uacute;mero de tel&eacute;fono: <input type="text" name="telefono" value="<?php echo $_SESSION['usuarioActual']->getTelefono() ?>"/>
            </p>
            <p><button type="submit">Cambiar mi número</button> <button type="submit">Darme de baja</button></p>
        </form>
    </body>
</html>
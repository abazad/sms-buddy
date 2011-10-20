<?php

session_start();
include_once 'clases/GestorFbApi.php';
include_once 'clases/GestorPersistencia.php';
include_once 'config.php';

if (isset($_SESSION['token_acceso_facebook'])) {
    $tokenAcceso = $_SESSION['token_acceso_facebook'];
    unset($_SESSION['token_acceso_facebook']);
    $usuarioFb = GestorFbApi::construyeUsuarioActual($tokenAcceso);
    $usuarioApp = GestorPersistencia::buscaUsuarioId($usuarioFb->getId());
    if (isset($usuarioApp)) {
        $_SESSION['usuarioActual'] = $usuarioApp;
        header('location: ' . URL_DISPATCHER . '?perfil');
        return;
    }
    $usuarioApp = $usuarioFb;
    $_SESSION['usuarioActual'] = $usuarioApp;
    header('location: ' . URL_BASE . 'registro.php');
    return;
} elseif (isset($_GET['code'])) {
    $cookieSesion = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
    session_write_close();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token?client_id=' . FACEBOOK_CLIENT_ID . '&redirect_uri=' . URL_AUT_FB . '&client_secret=' . FACEBOOK_CLIENT_SECRET . '&code=' . $_GET['code']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_COOKIE, $cookieSesion);
    $strRespuesta = curl_exec($curl);
    if ($strRespuesta == false)
        echo 'Tenemos problemas, por favor intenta de nuevo';
    session_start();
    parse_str($strRespuesta, $arrRespuestas);
    $_SESSION['token_acceso_facebook'] = $arrRespuestas['access_token'];
    header('location: ' . URL_AUT_FB);
    return;
}
elseif (isset($_GET['error'])) {
    header('location: ' . URL_BASE . '/error.php');
    return;
} else {
    $permisos = 'publish_stream,offline_access';
    echo '<script type=\'text/javascript\'>top.location.href = \'https://www.facebook.com/dialog/oauth?client_id=' . FACEBOOK_CLIENT_ID . '&redirect_uri=' . URL_AUT_FB . '&scope=' . $permisos . '\';</script>';
    return;
}
?>


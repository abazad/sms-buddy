<?php
include_once 'Usuario.php';
class GestorFbApi {

    public static function construyeUsuarioActual($tokenAcceso) {
        $resultado = self::llamaApiGet('https://graph.facebook.com/me', $tokenAcceso);
        if (isset($resultado['id'])) {
            $usuario = new Usuario();
            $usuario->setId($resultado['id']);
            $usuario->setNombre($resultado['name']);
            $usuario->setZugriff($tokenAcceso);
            return $usuario;
        }
        return $resultado;
    }

    public static function publicaMensaje($usuario, $mensaje) {
        $mensaje = urlencode($mensaje);
        $resultado = self::llamaApiPost('https://graph.facebook.com/' . $usuario->getId() . '/feed', 'message=' . $mensaje, $usuario->getZugriff(), true);
        echo $resultado;
        para();
    }

    private static function llamaApiGet($url, $tokenAcceso, $parametrosAntes = false) {
        $cookieSesion = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
        session_write_close();
        $curl = curl_init();
        if ($parametrosAntes == false)
            curl_setopt($curl, CURLOPT_URL, $url . '?access_token=' . $tokenAcceso);
        else
            curl_setopt($curl, CURLOPT_URL, $url . '&access_token=' . $tokenAcceso);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_COOKIE, $cookieSesion);
        $respuesta = curl_exec($curl);
        session_start();
        if ($respuesta == false)
            echo 'Tenemos problemas, por favor intenta de nuevo';
        $respuesta = json_decode($respuesta, true);
        return $respuesta;
    }

    private static function llamaApiPost($url, $strParametros, $tokenAcceso, $parametrosAntes = false) {
        $cookieSesion = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
        session_write_close();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        if ($parametrosAntes == false)
            $strParametros .= '?access_token=' . $tokenAcceso;
        else
            $strParametros .= '&access_token=' . $tokenAcceso;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strParametros);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_COOKIE, $cookieSesion);
        $respuesta = curl_exec($curl);
        session_start();
        if ($respuesta == false)
            echo 'Para los técnicos; GestorFbApi->llamaApiPost()';
        return $respuesta;
    }

}

?>

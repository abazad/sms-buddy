<?php

include_once './config.php';
include_once './libs/ezSql/ez_sql_core.php';
include_once './libs/ezSql/ez_sql_mysql.php';

class ConexionBd {

    private $bd;
    private static $conexion = null;

    private function __construct() {
        $this->bd = new ezSQL_mysql(USUARIO_BD, PASS_BD, NOMBRE_BD, HOST_BD);
    }

    public static function getInstance() {
        if (!isset(self::$conexion))
            self::$conexion = new ConexionBd();
        return self::$conexion;
        }

    public function getEzSql() {
        return $this->bd;
    }

}

?>

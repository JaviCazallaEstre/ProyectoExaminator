<?php
class Conn{
    protected static $conexion;
    public static function creaConexion(){
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET names utf8");
        return self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '', $opciones);
    }
}
<?php
class Conn{
    protected static $conexion;
    public static function creaConexion(){
        self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '');
    }
}
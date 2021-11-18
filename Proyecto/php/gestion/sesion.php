<?php
class Session
{
    public static function inicia()
    {
        session_start();
    }
    public static function leer($clave)
    {
        if (isset($_SESSION[$clave])) {
            $devuelve = $_SESSION[$clave];
        } else {
            $devuelve = "";
        }
        return $devuelve;
    }
    public static function escribir($clave, $contenido)
    {
        $_SESSION[$clave] = $contenido;
    }
    public static function elimina($clave)
    {
        $_SESSION[$clave];
    }
    public static function cierra()
    {
        session_destroy();
    }
    public static function usuarioLogueado($usuario){
        if(isset($_SESSION[$usuario])){
            return true;
        }else{
            return false;
        }
    }
}

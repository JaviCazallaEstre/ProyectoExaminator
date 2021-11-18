<?php
class BD{
    private static $conexion;
    public static function creaConexion(){
        self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '');
    }
    public static function existeUsuario($email, $contrasena)
    {
        $sentencia = "SELECT email, contrasena FROM usuarios WHERE email LIKE '$email'";
        $registros = self::$conexion->query($sentencia);
        while ($resultado = $registros->fetch()) {
            if ($resultado['email'] == $email && $resultado['contrasena'] == $contrasena) {
                return true;
            } else {
                return false;
            }
        }
    }
}
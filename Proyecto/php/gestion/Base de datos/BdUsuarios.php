<?php
include_once("../../entidades/usuarioObjeto.php");
class BdUsuario
{
    private static $conexion;
    public static function creaConexion()
    {
        self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '');
    }
    public static function insertaUsuario(Usuario $usuario)
    {
        $id=$usuario->id;
        $email=$usuario->email;
        $nombre=$usuario->nombre;
        $apellidos=$usuario->apellidos;
        $contrasena=$
        $sentencia = "INSERT INTO usuarios VALUES(:ID, :EMAIL, :NOMBRE, :APELLIDOS, :CONTRASENA, :FECHA_NAC, :FOTO, :ACTIVO, :ROL_ID)";
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

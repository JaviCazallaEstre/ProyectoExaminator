<?php
class Login
{
    public static function existeUsuario($email, $contrasena)
    {
        creaConexion();
        // $conexionCreada=self::$conexion;
        $sentencia = "SELECT * FROM usuarios WHERE email LIKE '$email'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch()) {
            if ($resultado['email'] == $email && $resultado['contrasena'] == $contrasena) {
                $persona = $resultado;
            } else {
                return false;
            }
        }
    }
}

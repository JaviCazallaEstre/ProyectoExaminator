<?php
require_once("../../cargadores/cargarBD.php");
require_once("../../cargadores/cargarclases.php");
class Login
{
    public static function existeUsuario($email, $contrasena)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM usuarios WHERE email LIKE '$email'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            if ($resultado['email'] == $email && $resultado['contrasena'] == $contrasena) {
                $persona = $resultado;
                $rol = BdRol::sacaRolId($persona["id"]);
                $objetoRol = new Rol($rol["id"], $rol["descripcion"]);
                return new Usuario($persona["id"], $persona["email"], $persona["nombre"], $persona["apellidos"], $persona["contrasena"], $persona["fecha_nac"], $persona["foto"], $objetoRol);
            } else {
                return false;
            }
        }
    }
}

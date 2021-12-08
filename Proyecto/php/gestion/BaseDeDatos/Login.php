<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class Login
{
    public static function existeUsuario($email, $contrasena)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM usuarios WHERE email LIKE '$email'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            var_dump($resultado);
            if ($resultado->email== $email && $resultado->contrasena == $contrasena) {
                echo "ole los caracoles";
                $persona = $resultado;
                $rol = BdRol::sacaRolId($persona->id);
                $objetoRol = new Rol($rol->id, $rol->descripcion);
                $usuario = new Usuario($persona->id, $persona->email, $persona->nombre, $persona->apellidos, $persona->contrasena, $persona->fecha_nac, $persona->foto, $objetoRol);
                $registros->closeCursor();
                $registros = null;
                $conexion = null;
                return $usuario;
            } else {
                $registros->closeCursor();
                $registros = null;
                $conexion = null;
                return false;
            }
        }
    }
}

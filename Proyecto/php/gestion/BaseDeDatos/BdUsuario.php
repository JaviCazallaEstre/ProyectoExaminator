<?php
require_once("../../cargadores/cargarBD.php");
require_once("../../cargadores/cargarclases.php");
class BdUsuario
{
    public static function insertaUsuario(Usuario $usuario)
    {
        $conexion = Conn::creaConexion();
        $id = $usuario->id;
        $email = $usuario->email;
        $nombre = $usuario->nombre;
        $apellidos = $usuario->apellidos;
        $contrasena = $usuario->contrasena;
        $fechaNac = $usuario->fecha_nac;
        $foto = $usuario->foto;
        $rol = $usuario->rol->id;
        $sentencia = "INSERT INTO usuarios VALUES(:ID, :EMAIL, :NOMBRE, :APELLIDOS, :CONTRASENA, :FECHA_NAC, :FOTO, :ROL_ID)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':ID', $id);
        $registros->bindParam(':EMAIL', $email);
        $registros->bindParam(':NOMBRE', $nombre);
        $registros->bindParam(':APELLIDOS', $apellidos);
        $registros->bindParam(':CONTRASENA', $contrasena);
        $registros->bindParam(':FECHA_NAC', $fechaNac);
        $registros->bindParam(':FOTO', $foto);
        $registros->bindParam('ROL_ID', $rol);
        $registros->execute();
    }
    public static function modificaUsuario(Usuario $usuario)
    {
        $conexion = Conn::creaConexion();
        $id = $usuario->id;
        $email = $usuario->email;
        $nombre = $usuario->nombre;
        $apellidos = $usuario->apellidos;
        $contrasena = $usuario->contrasena;
        $fechaNac = $usuario->fecha_nac;
        $foto = $usuario->foto;
        $rol = $usuario->rol->id;
        $sentencia = "UPDATE usuarios SET id = ?, nombre = ?, apellidos = ?, contrasena = ?, fecha_nac = ?, foto = ?, rol_id = ? WHERE id LIKE '$id'";
        $registros = $conexion->prepare($sentencia);
        $registros->execute($id, $nombre, $apellidos, $contrasena, $fechaNac, $foto, $rol);
    }
    public static function existeUsuario($email)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT email FROM usuarios WHERE email LIKE '$email'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch()) {
            if ($resultado['email'] == $email) {
                return true;
            } else {
                return false;
            }
        }
    }
    public static function borraUsuario($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "DELETE FROM usuarios WHERE ID like '$id'";
        $conexion->query($sentencia);
    }
    public static function sacaUsuarios()
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM usuarios";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $usuarios[] = $resultado;
        }
        return $usuarios;
    }
    public static function sacaUsuario($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM usuarios WHERE id='$id'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $usuario = $resultado;
        }
        return $usuario;
    }
}

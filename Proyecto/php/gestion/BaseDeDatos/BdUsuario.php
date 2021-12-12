<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
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
        $registros->bindParam(':ROL_ID', $rol);
        $registros->execute();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
    public static function insertaAlta($id, $email)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "INSERT INTO usuarios(id, email) VALUES(?, ?)";
        $registros = $conexion->prepare($sentencia);
        $registros->execute([$id, $email]);
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
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
        $sentencia = "UPDATE usuarios SET id = ?, email=?, nombre = ?, apellidos = ?, contrasena = ?, fecha_nac = ?, foto = ?, rol_id = ? WHERE id LIKE '$id'";
        $registros = $conexion->prepare($sentencia);
        $registros->execute([$id, $email, $nombre, $apellidos, $contrasena, $fechaNac, $foto, $rol]);
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
    private static function modificaUsuarioConexion($conexion, Usuario $usuario)
    {

        $id = $usuario->id;
        $email = $usuario->email;
        $nombre = $usuario->nombre;
        $apellidos = $usuario->apellidos;
        $contrasena = $usuario->contrasena;
        $fechaNac = $usuario->fecha_nac;
        $foto = $usuario->foto;
        $rol = $usuario->rol->id;
        $sentencia = "UPDATE usuarios SET id = ?, email=?, nombre = ?, apellidos = ?, contrasena = ?, fecha_nac = ?, foto = ?, rol_id = ? WHERE id LIKE '$id'";
        $registros = $conexion->prepare($sentencia);
        $registros->execute([$id, $email, $nombre, $apellidos, $contrasena, $fechaNac, $foto, $rol]);
    }
    public static function existeUsuario($email)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT email FROM usuarios WHERE email LIKE '$email'";
        $registros = $conexion->query($sentencia);
        $esta = false;
        while ($resultado = $registros->fetch()) {
            if ($resultado['email'] == $email) {
                $esta = true;
            }
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $esta;
    }
    public static function borraUsuario($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "DELETE FROM usuarios WHERE ID like '$id'";
        $conexion->query($sentencia);
        $conexion = null;
    }
    public static function sacaUsuarios()
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM usuarios";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $usuarios[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $usuarios;
    }
    public static function sacaUsuario($email)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM usuarios WHERE email ='$email'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $usuario = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $usuario;
    }
    public static function sacaUsuarioId($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM usuarios WHERE id ='$id'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $usuario = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $usuario;
    }
    public static function insertaBD(Usuario $usuario)
    {
        $conexion = Conn::creaConexion();
        try {
            $conexion->beginTransaction();
            self::modificaUsuarioConexion($conexion, $usuario);
            bdAltaUsuario::borraAlta($conexion, $usuario->email);
            $conexion->commit();
        } catch (PDOException $ex) {
            $conexion->rollBack();
        }
        $conexion = null;
    }
}

<?php
require_once("../../cargadores/cargarBD.php");
require_once("../../cargadores/cargarclases.php");
class BdRol
{
    public static function sacaRoles()
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM rol";
        $registros = $conexion->query($sentencia);
        $roles = array();
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $roles[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $roles;
    }

    public static function insertaRol(Rol $rol)
    {
        $conexion = Conn::creaConexion();
        $descripcion = $rol->descripcion;
        $sentencia = "INSERT INTO rol VALUES(:ID, :DESCRIPCION)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':ID', null);
        $registros->bindParam(':DESCRIPCION', $descripcion);
        $registros->execute();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }

    public static function sacaRol($descripcion)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM rol WHERE Descripcion LIKE '$descripcion'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $rol = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $rol;
    }
    public static function sacaRolId($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM rol WHERE id LIKE '$id'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $rol = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $rol;
    }
}

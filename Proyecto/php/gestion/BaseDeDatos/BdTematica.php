<?php
require_once("../../cargadores/cargarBD.php");
require_once("../../cargadores/cargarclases.php");
class BdTematica
{
    public static function sacaTematicas()
    {
        $conexion= Conn::creaConexion();
        $sentencia = "SELECT * FROM tematicas";
        $registros = $conexion->query($sentencia);
        $tematicas = array();
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $tematicas[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $tematicas;
    }

    public static function insertaTematica(Tematica $tematica)
    {
        $conexion= Conn::creaConexion();
        $descripcion = $tematica->descripcion;
        $sentencia = "INSERT INTO tematicas VALUES(:ID, :DESCRIPCION)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':ID', null);
        $registros->bindParam('DESCRIPCION', $descripcion);
        $registros->execute();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }

    public static function sacaTematica($descripcion)
    {
        $conexion= Conn::creaConexion();
        $sentencia = "SELECT * FROM tematicas WHERE Descripcion LIKE '$descripcion'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $tematica = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $tematica;
    }
}

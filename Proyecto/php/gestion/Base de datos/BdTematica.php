<?php
include_once("../../entidades/tematicaObjeto.php");
class BdTematica
{
    private static $conexion;
    public static function creaConexion()
    {
        self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '');
    }

    public static function sacaTematicas()
    {
        $sentencia = "SELECT * FROM tematicas";
        $registros = self::$conexion->query($sentencia);
        $tematicas = array();
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $tematicas[] = $resultado;
        }
        return $tematicas;
    }

    public static function insertaTematica(Tematica $tematica)
    {
        $descripcion = $tematica->descripcion;
        $sentencia = "INSERT INTO tematicas VALUES(:ID, :DESCRIPCION)";
        $registros = self::$conexion->prepare($sentencia);
        $registros->bindParam(':ID', null);
        $registros->bindParam('DESCRIPCION', $descripcion);
        $registros->execute();
    }

    public static function sacaTematica($descripcion)
    {
        $sentencia = "SELECT * FROM tematicas WHERE Descripcion LIKE '$descripcion'";
        $registros = self::$conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $tematica = $resultado;
        }
        return $tematica;
    }
}

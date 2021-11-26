<?php
include_once("../../entidades/examenObjeto.php");
class bdExamen{
    private static $conexion;
    public static function creaConexion(){
        self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '');
    }
    public static function insertaExamen(Examen $examen){
        $id=$examen->id;
        $descripcion=$examen->descripcion;
        $duracion=$examen->duracion;
        $numero=$examen->numero;
        $activo=$examen->activo;
        $sentencia= "INSERT INTO examen VALUES (:ID, :DESCRIPCION, :DURACION, :NUMERO, :ACTIVO)";
        $registros = self::$conexion->prepare($sentencia);
        $registros->bindParam(':ID', $id);
        $registros->bindParam(':DESCRIPCION',$descripcion);
        $registros->bindParam(':DURACION',$duracion);
        $registros->bindParam('NUMERO',$numero);
        $registros->bindParam(':ACTIVO',$activo);
        $registros->execute();
    }
}
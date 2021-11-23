<?php
include_once("../../entidades/rolObjeto.php");
class BdRol{
    private static $conexion;
    public static function creaConexion(){
        self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '');
    }

    public static function sacaRoles(){
        $sentencia="SELECT * FROM rol";
        $registros=self::$conexion->query($sentencia);
        $roles=array();
        while($resultado=$registros->fetch(PDO::FETCH_OBJ)){
            $roles[]=$resultado;
        }
        return $roles;
    }

    public static function insertaRol(Rol $rol){
        $descripcion=$rol->descripcion;
        $sentencia="INSERT INTO rol VALUES(:ID, :DESCRIPCION)";
        $registros=self::$conexion->prepare($sentencia);
        $registros->bindParam(':ID',null);
        $registros->bindParam('DESCRIPCION',$descripcion);
        $registros->execute();
    }

    public static function sacaRol($descripcion){
        $sentencia="SELECT * FROM rol WHERE Descripcion LIKE '$descripcion'";
        $registros=self::$conexion->query($sentencia);
        while($resultado=$registros->fetch(PDO::FETCH_OBJ)){
            $rol=$resultado;
        }
        return $rol;
    }
}
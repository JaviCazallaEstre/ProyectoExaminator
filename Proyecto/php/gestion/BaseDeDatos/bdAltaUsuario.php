<?php
require_once("../../cargadores/cargarBD.php");
require_once("../../cargadores/cargarclases.php");
class bdAltaUsuario{
    public static function insertaAlta($id,$correo){
        $conexion=Conn::creaConexion();
        $sentencia="INSERT INTO registropendiente VALUES(:ID, :CORREO)";
        $registros=$conexion->prepare($sentencia);
        $registros->bindParam(":ID",$id);
        $registros->bindParam(":CORREO",$correo);
        $registros->execute();
    }
    public static function borraAlta($id){
        $conexion=Conn::creaConexion();
        
    }
}
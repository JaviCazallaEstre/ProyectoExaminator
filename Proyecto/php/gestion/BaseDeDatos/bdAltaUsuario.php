<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class bdAltaUsuario
{
    public static function insertaAlta($id, $correo)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "INSERT INTO registropendiente VALUES(:ID, :CORREO)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(":ID", $id);
        $registros->bindParam(":CORREO", $correo);
        $registros->execute();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
    public static function borraAlta($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "DELETE FROM registropendiente WHERE ID LIKE '$id'";
        $conexion->query($sentencia);
        $conexion = null;
    }
    public static function cogeAlta($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM registropendiente WHERE ID LIKE'$id'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch()) {
            $alta = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $alta;
    }
}

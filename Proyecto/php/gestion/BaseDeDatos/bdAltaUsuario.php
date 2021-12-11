<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class bdAltaUsuario
{
    public static function insertaAlta($id, $hash, $correo)
    {
        $fecha_actual = date("d-m-Y");
        $fecha= date("d-m-Y", strtotime($fecha_actual . "+ 1 days"));
        $conexion = Conn::creaConexion();
        $sentencia = "INSERT INTO registropendiente VALUES(:ID, :HASH, :CORREO, :FECHAEXPIRACION)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(":ID", $id);
        $registros->bindParam(":HASH", $hash);
        $registros->bindParam(":CORREO", $correo);
        $registros->bindParam(":FECHAEXPIRACION",$fecha);
        $registros->execute();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
    public static function borraAlta($correo)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "DELETE FROM registropendiente WHERE CORREO LIKE '$correo'";
        $conexion->query($sentencia);
        $conexion = null;
    }
    public static function cogeAlta($correo)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM registropendiente WHERE CORREO LIKE'$correo'";
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

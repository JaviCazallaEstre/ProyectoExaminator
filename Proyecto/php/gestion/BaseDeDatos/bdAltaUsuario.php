<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class bdAltaUsuario
{
    public static function insertaAlta($id, $hash, $correo)
    {
        $fecha_actual = date("Y-m-d");
        $fecha = date("Y-m-d", strtotime($fecha_actual . "+ 1 days"));
        $conexion = Conn::creaConexion();
        $sentencia = "INSERT INTO registropendiente (id, hash, correo, fechaexpiracion) VALUES(?, ?, ?, ?)";
        $registros = $conexion->prepare($sentencia);
        $registros->execute([$id, $hash, $correo, $fecha]);
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
    public static function borraAlta($conexion,$correo)
    {
        $sentencia = "DELETE FROM registropendiente WHERE CORREO LIKE '$correo'";
        $conexion->query($sentencia);
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
    public static function comparaHash($id, $hash)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT hash FROM registropendiente WHERE ID LIKE'$id'";
        $registros = $conexion->query($sentencia);
        $esta = false;
        while ($resultado = $registros->fetch()) {
            if ($resultado['hash'] == $hash) {
                $esta = true;
            }
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $esta;
    }
}

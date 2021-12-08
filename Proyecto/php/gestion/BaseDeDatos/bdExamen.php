<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class bdExamen
{
    public static function insertaExamen(Examen $examen)
    {
        $conexion = Conn::creaConexion();
        $id = $examen->id;
        $descripcion = $examen->descripcion;
        $duracion = $examen->duracion;
        $numero = $examen->numero;
        $activo = $examen->activo;
        $sentencia = "INSERT INTO examen VALUES (:ID, :DESCRIPCION, :DURACION, :NUMERO, :ACTIVO)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':ID', $id);
        $registros->bindParam(':DESCRIPCION', $descripcion);
        $registros->bindParam(':DURACION', $duracion);
        $registros->bindParam('NUMERO', $numero);
        $registros->bindParam(':ACTIVO', $activo);
        $registros->execute();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
    public static function borraExamen($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "DELETE FROM examen WHERE ID LIKE '$id'";
        $conexion->query($sentencia);
        $conexion = null;
    }
    public static  function sacaExamenes()
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM examen";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $examenes[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $examenes;
    }
    public static  function sacaExamen($id)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT * FROM examen WHERE ID LIKE '$id'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $examen = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $examen;
    }
    public static function modificaExamen(Examen $examen)
    {
        $id = $examen->id;
        $descripcion = $examen->descripcion;
        $duracion = $examen->duracion;
        $numero = $examen->numero;
        $activo = $examen->activo;
        $conexion = Conn::creaConexion();
        $sentencia = "UPDATE examen SET id=?, descripcion=?, duracion=?, numero=?, activo=?";
        $registros = $conexion->query($sentencia);
        $registros->execute($id, $descripcion, $duracion, $numero, $activo);
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
}

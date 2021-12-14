<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class BdExamenHecho
{
    public static function insertaExamen(ExamenHecho $examen)
    {
        $conexion = Conn::creaConexion();
        $id = $examen->id;
        $respuestas = $examen->respuestas;
        $idExamen = $examen->idExamen;
        $idUsuario = $examen->idUsuario;
        $sentencia = "INSERT INTO examenhechos VALUES(:ID, NOW(), :RESPUESTAS, :EXAMEN_ID, :USUARIOS_ID)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':ID', $id);
        $registros->bindParam(":RESPUESTAS", $respuestas);
        $registros->bindParam("EXAMEN_ID", $idExamen);
        $registros->bindParam("USUARIOS_ID", $idUsuario);
        $registros->execute();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
}

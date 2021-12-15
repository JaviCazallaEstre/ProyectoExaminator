<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class BdPregunta
{
    public static function insertaPregunta($conexion, Pregunta $pregunta)
    {
        $id = null;
        $enunciado = $pregunta->enunciado;
        $recurso = $pregunta->multimedia;
        $idTematica = $pregunta->idTematica;
        $sentencia = "INSERT INTO pregunta VALUES(:ID, :ENUNCIADO, :RECURSO, :TEMATICAS_ID)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(":ID", $id);
        $registros->bindParam(":ENUNCIADO", $enunciado);
        $registros->bindParam(":RECURSO", $recurso);
        $registros->bindParam(":TEMATICAS_ID", $idTematica);
        $registros->execute();
        return $conexion->lastInsertId();
    }
    public static function insertaRespuesta($conexion, Respuesta $respuesta, $idPregunta)
    {
        $id = null;
        $enunciado = $respuesta->enunciado;
        $sentencia = "INSERT INTO respuesta VALUES(:ID, :ENUNCIADO, :PREGUNTA_ID)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':ID', $id);
        $registros->bindParam(':ENUNCIADO', $enunciado);
        $registros->bindParam(':PREGUNTA_ID', $idPregunta);
        $registros->execute();
        return $conexion->lastInsertId();
    }
    public static function sacaIdPreguntas()
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT id FROM pregunta";
        $registros = $conexion->query($sentencia);
        $idPreguntas = array();
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $idPreguntas[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $idPreguntas;
    }
    public static function sacaIdRespuestas($idPregunta)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT id FROM respuesta WHERE pregunta_id LIKE '$idPregunta'";
        $registros = $conexion->query($sentencia);
        $idRespuestas = array();
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $idRespuestas[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $idRespuestas;
    }
    public static function insertRespuestaCorrecta($conexion, $idPregunta, $idRespuesta)
    {
        $sentencia = "INSERT INTO pregunta_correcta VALUES(:PREGUNTA_ID, :RESPUESTA_ID)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':PREGUNTA_ID', $idPregunta);
        $registros->bindParam(':RESPUESTA_ID', $idRespuesta);
        $registros->execute();
    }
    public static function inserta(Pregunta $pregunta, Respuesta $respuesta1, Respuesta $respuesta2, Respuesta $respuesta3, Respuesta $respuesta4, $respuestaCorrecta)
    {
        $conexion = Conn::creaConexion();
        try {
            $conexion->beginTransaction();
            $idPregunta = self::insertaPregunta($conexion, $pregunta);
            $idRespuesta1 = self::insertaRespuesta($conexion, $respuesta1, $idPregunta);
            $idRespuesta2 = self::insertaRespuesta($conexion, $respuesta2, $idPregunta);
            $idRespuesta3 = self::insertaRespuesta($conexion, $respuesta3, $idPregunta);
            $idRespuesta4 = self::insertaRespuesta($conexion, $respuesta4, $idPregunta);
            switch ($respuestaCorrecta) {
                case 1:
                    $idRespuestaCorrecta = $idRespuesta1;
                    break;
                case 2:
                    $idRespuestaCorrecta = $idRespuesta2;
                    break;
                case 3:
                    $idRespuestaCorrecta = $idRespuesta3;
                    break;
                case 4:
                    $idRespuestaCorrecta = $idRespuesta4;
                    break;
            }
            self::insertRespuestaCorrecta($conexion, $idPregunta, $idRespuestaCorrecta);
            $conexion->commit();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $conexion->rollBack();
            $conexion = null;
        }
        $conexion = null;
    }
    public static function sacaPreguntas()
    {
        $conexion = Conn::creaConexion();
        $sentencia = "SELECT pregunta.id, pregunta.enunciado, pregunta.recurso, (SELECT tematicas.descripcion FROM tematicas WHERE tematicas.id = pregunta.tematicas_id) AS 'tematica' FROM examinador.pregunta";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $preguntas[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $preguntas;
    }
    public static function sacaRespuestasPregunta($idPregunta){
        $conexion=Conn::creaConexion();
        $sentencia = "SELECT * FROM respuesta WHERE pregunta_id LIKE '$idPregunta'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $respuestas[] = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $respuestas;
    }
    public static function sacaPregunta($idPregunta){
        $conexion=Conn::creaConexion();
        $sentencia = "SELECT * FROM pregunta WHERE id LIKE '$idPregunta'";
        $registros = $conexion->query($sentencia);
        while ($resultado = $registros->fetch(PDO::FETCH_OBJ)) {
            $pregunta = $resultado;
        }
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $pregunta;
    }
}

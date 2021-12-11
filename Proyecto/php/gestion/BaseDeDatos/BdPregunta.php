<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class BdPregunta
{
    public static function insertaPregunta(Pregunta $pregunta)
    {
        $id = null;
        $enunciado = $pregunta->enunciado;
        $recurso = $pregunta->multimedia;
        $idTematica = $pregunta->idTematica;
        $idCorrecta = $pregunta->respuestaCorrecta;
        $conexion = Conn::creaConexion();
        $sentencia = "INSERT INTO pregunta VALUES(:ID, :ENUNCIADO, :RECURSO, :TEMATICAS_ID, :RESPUESTA_ID)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(":ID", $id);
        $registros->bindParam(":ENUNCIADO", $enunciado);
        $registros->bindParam(":RECURSO", $recurso);
        $registros->bindParam(":TEMATICAS_ID", $idTematica);
        $registros->bindParam(':RESPUESTA_ID', $idCorrecta);
        $registros->execute();
        $id=$conexion->lastInsertId();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $id;
    }
    public static function insertaRespuesta(Respuesta $respuesta, $idPregunta)
    {
        $id = null;
        $enunciado = $respuesta->enunciado;
        $conexion = Conn::creaConexion();
        $sentencia = "INSERT INTO respuesta VALUES(:ID, :ENUNCIADO, :PREGUNTA_ID)";
        $registros = $conexion->prepare($sentencia);
        $registros->bindParam(':ID', $id);
        $registros->bindParam(':ENUNCIADO', $enunciado);
        $registros->bindParam(':PREGUNTA_ID', $idPregunta);
        $registros->execute();
        $id = $conexion->lastInsertId();
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
        return $id;
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
    public static function updateRespuestaCorrecta($idPregunta, $idRespuesta)
    {
        $conexion = Conn::creaConexion();
        $sentencia = "UPDATE pregunta SET respuesta_id=? WHERE id LIKE '$idPregunta'";
        $registros = $conexion->prepare($sentencia);
        $registros->execute([$idRespuesta]);
        $registros->closeCursor();
        $registros = null;
        $conexion = null;
    }
    public static function inserta(Pregunta $pregunta, Respuesta $respuesta1, Respuesta $respuesta2, Respuesta $respuesta3, Respuesta $respuesta4, $respuestaCorrecta)
    {
        $conexion = Conn::creaConexion();
        try {
            $conexion->beginTransaction();
            $id = self::insertaPregunta($pregunta);
            $idRespuesta1 = self::insertaRespuesta($respuesta1, $id);
            $idRespuesta2 = self::insertaRespuesta($respuesta2, $id);
            $idRespuesta3 = self::insertaRespuesta($respuesta3, $id);
            $idRespuesta4 = self::insertaRespuesta($respuesta4, $id);
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
            self::updateRespuestaCorrecta($id, $idRespuestaCorrecta);
            $conexion->commit();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $conexion->rollBack();
            $conexion = null;
        }
    }
}

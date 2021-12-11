<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class Pregunta
{
    private $idPregunta;
    private $enunciado;
    private $multimedia;
    private $idTematica;
    private $respuestaCorrecta;

    public function __construct($idPregunta, $enunciado, $multimedia, $idTematica, Respuesta $respuestaCorrecta = null)
    {
        $this->idPregunta = $idPregunta;
        $this->enunciado = $enunciado;
        $this->multimedia = $multimedia;
        $this->idTematica = $idTematica;
        $this->respuestaCorrecta = $respuestaCorrecta;
    }
    public function __set($propiedad, $valor)
    {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }
    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
    }
}

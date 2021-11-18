<?php
class Pregunta
{
    private $idPregunta;
    private $enunciado;
    //private array $respuestas;
    private $multimedia;
    private $idTematica;
    private $idRespuestaCorrecta;

    public function __construct($idPregunta, $enunciado, $multimedia, $idTematica, $idRespuestaCorrecta)
    {
        $this->idPregunta = $idPregunta;
        $this->enunciado = $enunciado;
        //$this->respuestas = $respuestas;
        $this->multimedia = $multimedia;
        $this->idTematica = $idTematica;
        $this->idRespuestaCorrecta = $idRespuestaCorrecta;
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

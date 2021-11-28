<?php
require_once("../../cargadores/cargarclases.php");
class Respuesta
{
    private $id;
    private $enunciado;
    private $pregunta;

    public function __construct($id, $enunciado, Pregunta $pregunta=null)
    {
        $this->id = $id;
        $this->enunciado = $enunciado;
        $this->pregunta = $pregunta;
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

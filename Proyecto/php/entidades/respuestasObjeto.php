<?php
class Respuesta{
    private $id;
    private $enunciado;
    private $idPregunta;

    public function __construct($id,$enunciado,$idPregunta)
    {
        $this->id=$id;
        $this->enunciado=$enunciado;
        $this->idPregunta=$idPregunta;
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
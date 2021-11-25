<?php
include_once("../entidades/usuarioObjeto.php");
include_once("../entidades/examenObjeto.php");
class examenHecho
{
    private $id;
    private $fecha;
    private $respuestas = [];
    private $calificacion;
    private $idExamen;
    private $idUsuario;

    public function __construct($id, $fecha, $respuestas, $calificacion, Examen $idExamen, Usuario $idUsuario)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->respuestas = $respuestas;
        $this->calificacion = $calificacion;
        $this->idExamen = $idExamen;
        $this->idUsuario = $idUsuario;
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

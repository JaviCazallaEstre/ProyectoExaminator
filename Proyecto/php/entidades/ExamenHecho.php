<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class ExamenHecho
{
    private $id;
    private $fecha;
    private $respuestas;
    private $idExamen;
    private $idUsuario;

    public function __construct($id, $fecha, $respuestas, $idExamen, $idUsuario)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->respuestas = $respuestas;
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

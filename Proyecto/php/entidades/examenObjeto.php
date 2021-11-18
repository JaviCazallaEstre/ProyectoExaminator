<?php
class Examen
{
    private $id;
    private $descripcion;
    private $duracion;
    private $numero;
    private $activo;

    public function __construct($id, $descripcion, $duracion, $numero, $activo)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->duracion = $duracion;
        $this->numero = $numero;
        $this->activo = $activo;
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

<?php
class Examen
{
    private $id;
    private $descripcion;
    private $duracion;
    private $activo;

    public function __construct($id, $descripcion, $duracion, $activo)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->duracion = $duracion;
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

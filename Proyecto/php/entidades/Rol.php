<?php
class Rol
{
    private $id;
    private $descripcion;

    public function __construct($id, $descripcion)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
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

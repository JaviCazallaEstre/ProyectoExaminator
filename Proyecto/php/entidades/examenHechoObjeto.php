<?php
class ExamenHecho{
    private $id;
    private $fecha;
    private array $respuestas;
    private $calificacion;
    private $id_examen;
    private $id_usuario;

    public function __construct($id,$fecha,$respuestas,$calificacion,$id_examen,$id_usuario)
    {
        $this->id=$id;
        $this->fecha=$fecha;
        $this->respuestas=$respuestas;
        $this->calificacion=$calificacion;
        $this->id_examen=$id_examen;
        $this->id_usuario=$id_usuario;
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
<?php
include_once("rolObjeto.php");
class Usuario
{
    private $email;
    private $nombre;
    private $apellidos;
    private $contrasena;
    private $fecha_nac;
    private $foto;
    private $rol;

    public function __construct($email, $nombre, $apellidos, $contrasena, $fecha_nac, $foto, Rol $rol)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->contrasena = $contrasena;
        $this->fecha_nac = $fecha_nac;
        $this->foto = $foto;
        $this->rol = $rol;
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

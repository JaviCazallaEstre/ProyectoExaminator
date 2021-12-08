<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarBD.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Proyecto/ProyectoExaminator/Proyecto/php/cargadores/cargarClases.php");
class BdListar
{
    public static function sacaLista(String $nombreTabla)
    {
        if ($nombreTabla == "persona") {
            $sql = "Select concat(nombre,' ',ap1,' ',ap2) as 'Nombre' ,
                                email as 'Correo electrónico', 
                                (Select nombreRol from proyecto.rol 
                                        where proyecto.rol.idRol = 
                                        proyecto.persona.rol) as 'Rol', 

                                (select count(proyecto.examenhecho.idPersona) 
                                        from proyecto.examenHecho 
                                        where proyecto.examenhecho.idexamenHecho = 
                                        proyecto.persona.idPersona) 
                                        as 'Examenes realizados' ,

                                (select estado from proyecto.activo 
                                        where proyecto.activo.idActivo = 
                                        proyecto.persona.activo) as 'Activo', 
                                        
                                fechaNac as 'Fecha nacimiento' 
                            from proyecto.${nombreTabla}";
        } else {
            $sql = "Select * from proyecto.${nombreTabla}";
        }
        $conexion=Conn::creaConexion();
        $peticion = $conexion->prepare($sql);
        $peticion->execute();
        $object = new stdClass();
        $object->resultado = $peticion->fetchAll(PDO::FETCH_NUM);
        $columnasCabecera = $peticion->columnCount();
        for ($i = 0; $i < $columnasCabecera; $i++) {
            $celdaCabecera = $peticion->getColumnMeta($i);
            $object->cabecera[] = $celdaCabecera['name'];
        }
        $object->tabla = $nombreTabla;

        return json_encode($object);
    }
}

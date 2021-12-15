<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
Session::inicia();
if(!Session::usuarioLogueado("usuario")){
    //header("Location: ../../index.php");
}
if(Session::leer("rol")==2){
    //header("Location: ../Principal.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/listaExamenes.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/listaExamenes.css" />
    <title>Lista examenes</title>
</head>

<body>
    <header>
        <?php
        //if(Session::leer("rol")==1){
            CreaCabecera::creaCabeceraProfesor();
        //}else{
        //    CreaCabecera::creaCabeceraAlumno();
        //}
        ?>
    </header>
    <div class="contenido">
        <form action="http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/creaExamen.php">
            <input type="submit" value="Crea examen" />
        </form>
        <table>
            <thead>
                <th>ID</th>
                <th>Descripci&oacute;n</th>
                <th>Duraci&oacute;n</th>
                <th>Activo</th>
                <th>Acci&oacute;n</th>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
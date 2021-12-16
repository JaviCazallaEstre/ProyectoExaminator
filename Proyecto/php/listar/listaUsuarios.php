<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
Session::inicia();
if(!Session::usuarioLogueado("usuario")){
    header("Location: ../../index.php");
}
if(Session::leer("rol")==2){
    header("Location: ../Principal.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/listarUsuarios.css" />
    <script src="../../js/listaUsuario.js"></script>
    <title>Lista usuarios</title>
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <div class="contenido">
        <div class="formularios">
            <form action="http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/altaUsuario.php">
                <input type="submit" value="Alta usuario" />
            </form>
            <form action="http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/altaMasivaUsuario.php">
                <input type="submit" value="Alta masiva usuario" />
                <input type="text" id="Buscador"/>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rol</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("","");
        ?>
    </footer>
</body>

</html>
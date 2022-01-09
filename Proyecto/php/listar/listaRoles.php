<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
Session::inicia();
if (!Session::usuarioLogueado("usuario")) {
    //header("Location: ../../index.php");
}
if (Session::leer("rol") == 2) {
    //header("Location: ../Principal.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/listaRoles.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/main.css" />
    <title>Lista roles</title>
</head>

<body>
    <header class="cabecera">
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <main class="contenidoListar">
        <form action="http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/creaRol.php">
            <input type="submit" value="Crea rol" />
            <input type="text" id="Buscador" />
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripci&oacute;n</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </main>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
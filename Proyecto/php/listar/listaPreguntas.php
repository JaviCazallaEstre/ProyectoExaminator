<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/listaPreguntas.js"></script>
    <title>Lista preguntas</title>
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <div id="contenido">
        <form action="http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/creaPregunta.php">
            <input type="submit" value="Crea pregunta" />
        </form>
        <table>
            <thead>
                <th>ID</th>
                <th>Enunciado</th>
                <th>Tem&aacute;tica</th>
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
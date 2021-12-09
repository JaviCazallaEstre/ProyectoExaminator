<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea examen</title>
    <link rel="stylesheet" type="text/css" href="../../css/creaExamen.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <script src="../../js/creaExamen.js"></script>
</head>
<header>
    <?php
    CreaCabecera::creaCabeceraProfesor();
    ?>
</header>

<body>
    <div class="contenido">
        <form name="formu" id="formu" method="POST">
            <table>
                <tr>
                    <td>
                        <label for="descripcion">Descripcion:</label>
                    </td>
                    <td>
                        <input type="text" id="descripcion" name="descripcion" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="duracion">Duracion:</label>
                    </td>
                    <td>
                        <input type="number" id="duracion" name="duracion" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="activo">Activo:</label>
                    </td>
                    <td>
                        <input type="checkbox" id="activo" name="activo" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="seleccionables">Preguntas seleccionables:</label>
                    </td>
                    <td>
                        <label for="seleccionadas">Preguntas seleccionadas:</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="seleccionables" name="seleccionable"></div>
                    </td>
                    <td>
                        <div id="seleccionadas" name="seleccionadas"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="crear" id="crear" value="Crear" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
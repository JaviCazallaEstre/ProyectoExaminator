<?php
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
require_once("../cargadores/cargarGestion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta masiva de usuarios</title>
</head>
<body>
    <header>
        <?php
            CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <form id="formu" name="formu" enctype="multipart/form-data" method="POST">
        <table>
            <tr>
                <td>
                    <label for="usuarios">Inserte los datos del alumno. Formato(email,fecha)</label>
                </td>
            </tr>
            <tr>
                <td id="tdTextArea">
                    <textarea id="textarea" name="textarea"></textarea>
                </td>
            </tr>
            <tr>
                <td id="tdArchivo">
                    <input type="file" name="archivo" id="archivo"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="enviar" id="enviar" value="Enviar"/>
                </td>
            </tr>
        </table>
    </form>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("","");
        ?>
    </footer>
</body>
</html>
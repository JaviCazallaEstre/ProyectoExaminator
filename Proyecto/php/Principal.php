<?php
require_once("cargadores/cargarGestion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoescuela Javi</title>
</head>

<body>
    <header>
        <?php
        if (Session::leer($usuario[$rol->descripcion]) == "profesor") {
            CreaCabecera::creaCabeceraProfesor();
        } else {
            CreaCabecera::creaCabeceraAlumno();
        }
        ?>
    </header>
    <div>
        <h1>Bienvenido a la Autoescuela Javi</h1>
        <p>
            Este es el sitio web de Autoescuela Javi en esta web podr&aacute;s preparar tu
            te&oacute;rico mediante nuestros ex&aacute;menes donde pondr&aacute;s a prueba tus
            concocimientos y te garantizamos el salir preparado al examen de verdad.
        </p>
    </div>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
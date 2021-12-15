<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
Session::inicia();
if (!Session::usuarioLogueado("usuario")) {
    header("Location: ../../index.php");
}
if (isset($_POST["finalizar"])) {
    $examen = new ExamenHecho(null, null, $_POST["respuestas"], $_POST["idExamen"], Session::leer("idUsuario"));
    BdExamenHecho::insertaExamen($examen);
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
    <link rel="stylesheet" type="text/css" href="../../css/creaExamenHecho.css" />
    <script src="../../js/creaExamenHecho.js"></script>
    <title>Realiza examen</title>
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraAlumno();
        ?>
    </header>
    <form id="formulario" name="formulario" method="POST">
        <div id="contenido">

            <input type="submit" name="finalizar" id="finalizar" value="Finalizar" />
        </div>
    </form>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
<?php
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
require_once("../cargadores/cargarGestion.php");
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
    <title>Alta masiva de usuarios</title>
    <script src="../../js/altaMasivaUsuario.js"></script>
    <script src="../../js/libreria/prototiposString.js"></script>
    <script src="../../js/libreria/metodos.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/altaMasivaUsuario.css" />
</head>
<body>
    <header>
        <?php
            CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <div class="contenido">
    <form id="formu" name="formu" enctype="multipart/form-data" method="POST">
        <table>
            <tr>
                <td>
                    <label for="usuarios">Inserte el email del alumno:</label>
                </td>
            </tr>
            <tr>
                <td id="tdEmail">
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
    </div>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("","");
        ?>
    </footer>
</body>
</html>
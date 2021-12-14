<?php
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
require_once("../cargadores/cargarGestion.php");
Session::inicia();
if(!Session::usuarioLogueado("usuario")){
    //header("Location: ../../index.php");
}
if(Session::leer("rol")==2){
    //header("Location: ../Principal.php");
}
if (isset($_POST["crear"])) {
    $errores = array();
    if ($_POST["nombre"] == "") {
        $errores["nombre"] = "El campo de nombre debe de estar relleno";
    }
    if (count($errores) == 0) {
        $rol = new Rol(null, $_POST["nombre"]);
        BdRol::insertaRol($rol);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear rol</title>
    <script src="../../js/creaRol.js"></script>
    <script src="../../js/libreria/metodos.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/creaRol.css" />
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <div class="contenido"> 
        <form id="formu" method="POST" name="formu">
            <table>
                <tr>
                    <td>
                        <label for="nombre">Nombre: *</label>
                    </td>
                    <td id="tdNombre">
                        <input type="text" id="nombre" name="nombre" />
                        <?php
                        if (isset($errores["nombre"])) {
                            echo "<p class='error'>" . $errores["nombre"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" id="crear" name="crear" value="Crear" />
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
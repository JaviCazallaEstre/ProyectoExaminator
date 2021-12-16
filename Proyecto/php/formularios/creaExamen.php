<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
Session::inicia();
if (!Session::usuarioLogueado("usuario")) {
    header("Location: ../../index.php");
}
if (Session::leer("rol") == 2) {
    header("Location: ../Principal.php");
}
if (isset($_POST["crear"])) {
    $errores = array();
    if ($_POST["descripcion"] == "") {
        $errores["descripcion"] = "La descripcion debe de estar rellena";
    }
    if ($_POST["duracion"] == "") {
        $errores["duracion"] = "La duracion debe de estar rellena";
    }
    $preguntas = array();
    $preguntas = json_decode($_POST["preguntas"]);
    if (count($preguntas) == 0) {
        $errores["preguntas"] = "No has seleccionado preguntas";
    }
    if (count($errores) == 0) {
        $examen = new Examen(null, $_POST["descripcion"], $_POST["duracion"], $_POST["activo"]);
        bdExamen::insertaExamenCompleto($examen, $preguntas);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea examen</title>
    <link rel="stylesheet" type="text/css" href="../../css/creaExamen.css" />
    <script src="../../js/libreria/metodos.js"></script>
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
    <main class="contenido">
        <form name="formu" id="formu" method="POST">
            <table>
                <tr>
                    <td>
                        <label for="descripcion">Descripcion:</label>
                    </td>
                    <td id="tdDescripcion">
                        <input type="text" id="descripcion" name="descripcion" />
                        <?php
                        if (isset($errores["descripcion"])) {
                            echo "<p class='error'>" . $errores["descripcion"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="duracion">Duracion:</label>
                    </td>
                    <td id="tdDuracion">
                        <input type="number" id="duracion" name="duracion" />
                        <?php
                        if (isset($errores["duracion"])) {
                            echo "<p class='error'>" . $errores["duracion"] . "</p>";
                        }
                        ?>
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
                    <td id="tdSeleccionadas">
                        <div id="seleccionadas" name="seleccionadas"></div>
                        <?php
                        if (isset($errores["seleccionadas"])) {
                            echo "<p class='error'>" . $errores["seleccionadas"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="crear" id="crear" value="Crear" />
                    </td>
                </tr>
            </table>
        </form>
    </main>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
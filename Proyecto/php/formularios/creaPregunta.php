<?php
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
require_once("../cargadores/cargarGestion.php");
Session::inicia();
if(!Session::usuarioLogueado("usuario")){
    echo "nada";
}
if (isset($_POST["enviar"])) {
    $errores = array();
    if ($_POST["enunciado"] == "") {
        $errores["enunciado"] = "El enunciado debe de estar relleno";
    }
    if ($_POST["opcion1"] == "") {
        $errores["opcion1"] == "La primera opcion debe de estar rellena";
    }
    if ($_POST["opcion2"] == "") {
        $errores["opcion2"] = "La segunda opción debe de estar rellena";
    }
    if ($_POST["opcion3"] == "") {
        $errores["opcion3"] = "La tercera opción debe de estar rellena";
    }
    if ($_POST["opcion4"] == "") {
        $errores["opcion4"] = "La cuarta opción debe de estar rellena";
    }
    if ($_POST["correcta"] == "") {
        $errores["correcta"] = "Debes elegir una opcion correcta";
    }
    if (isset($_FILES["archivo"])) {
        $permitidos = array("image/png", "image/jpeg", "image/jpg", "image/gif", "video/mp4", "video/mpg", "video/mpeg", "video/avi");
        $limitekb = 4096;
        if (in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limitekb * 1024) {
            $ruta = "../../Recursos/Preguntas/" . $_FILES["archivo"]["name"];
            move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        } else if (!in_array($_FILES["archivo"]["type"], $permitidos)) {
            $errores["archivo"] = "El recurso debe de ser una foto o un vídeo";
        } else {
            $errores["archivo"] = "El peso del archivo supera el limite de 4MB";
        }
    }
    if (count($errores) == 0) {
        $opcion1 = new Respuesta(null, $_POST["opcion1"], null);
        $opcion2 = new Respuesta(null, $_POST["opcion2"], null);
        $opcion3 = new Respuesta(null, $_POST["opcion3"], null);
        $opcion4 = new Respuesta(null, $_POST["opcion4"], null);
        if (isset($_FILES["archivo"])) {
            $pregunta = new Pregunta(null, $_POST["enunciado"], $_FILES["archivo"]["name"], $_POST["tematica"], null);
        } else {
            $pregunta = new Pregunta(null, $_POST["enunciado"], null, $_POST["tematica"], null);
        }
        BdPregunta::inserta($pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $_POST["correcta"]);
    }
}
function rellenaSelect()
{
    $tematicas = BdTematica::sacaTematicas();
    for ($i = 0; $i < count($tematicas); $i++) {
        echo '<option value="' . $tematicas[$i]->id . '">' . $tematicas[$i]->descripcion . '</option>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea pregunta</title>
    <script src="../../js/creaPregunta.js"></script>
    <script src="../../js/libreria/metodos.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/creaPregunta.css" />
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <div class="contenido">
        <form id="formu" name="formu" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td id="enunciadoTematica">
                        <label for="tematica">Tem&aacute;tica:</label>
                    </td>
                    <td id="tdTematica">
                        <select id="tematica" name="tematica">
                            <?php
                            rellenaSelect();
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="enunciado">Enunciado:</label>
                    </td>
                </tr>
                <tr>
                    <td id="tdEnunciado">
                        <textarea id="enunciado" name="enunciado" value="<?php
                                                                            if (isset($errores["enunciado"])) {
                                                                                echo "";
                                                                            } else if (isset($_POST["enunciado"])) {
                                                                                echo $_POST["enunciado"];
                                                                            } else {
                                                                                echo "";
                                                                            }
                                                                            ?>"></textarea>
                        <?php
                        if (isset($errores["enunciado"])) {
                            echo "<p class='error'>" . $errores["enunciado"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="opcion1">Opci&oacute;n 1:</label>
                    </td>
                </tr>
                <tr>
                    <td id="tdOpcion1">
                        <input type="text" id="opcion1" name="opcion1" value="<?php
                                                                                if (isset($errores["opcion1"])) {
                                                                                    echo "";
                                                                                } else if (isset($_POST["opcion1"])) {
                                                                                    echo $_POST["opcion1"];
                                                                                } else {
                                                                                    echo "";
                                                                                }
                                                                                ?>" />
                        <?php
                        if (isset($errores["opcion1"])) {
                            echo "<p class='error'>" . $errores["opcion1"] . "</p>";
                        }
                        ?>
                    </td>
                    <td>
                        <input type="radio" id="correcta1" name="correcta" value="1" />
                        <label for="radio1">Correcta</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="opcion2">Opci&oacute;n 2:</label>
                    </td>
                </tr>
                <tr>
                    <td id="tdOpcion2">
                        <input type="text" id="opcion2" name="opcion2" value="<?php
                                                                                if (isset($errores["opcion2"])) {
                                                                                    echo "";
                                                                                } else if (isset($_POST["opcion2"])) {
                                                                                    echo $_POST["opcion2"];
                                                                                } else {
                                                                                    echo "";
                                                                                }
                                                                                ?>" />
                        <?php
                        if (isset($errores["opcion2"])) {
                            echo "<p class='error'>" . $errores["opcion2"] . "</p>";
                        }
                        ?>
                    </td>
                    <td>
                        <input type="radio" id="correcta2" name="correcta" value="2" />
                        <label for="radio2">Correcta</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="opcion3">Opci&oacute;n 3</label>
                    </td>
                </tr>
                <tr>
                    <td id="tdOpcion3">
                        <input type="text" id="opcion3" name="opcion3" value="<?php
                                                                                if (isset($errores["opcion3"])) {
                                                                                    echo "";
                                                                                } else if (isset($_POST["opcion3"])) {
                                                                                    echo $_POST["opcion3"];
                                                                                } else {
                                                                                    echo "";
                                                                                }
                                                                                ?>" />
                        <?php
                        if (isset($errores["opcion3"])) {
                            echo "<p class='error'>" . $errores["opcion3"] . "</p>";
                        }
                        ?>
                    </td>
                    <td>
                        <input type="radio" id="correcta3" name="correcta" value="3" />
                        <label for="radio3">Correcta</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="opcion4">Opci&oacute;n 4:</label>
                    </td>
                </tr>
                <tr>
                    <td id="tdOpcion4">
                        <input type="text" id="opcion4" name="opcion4" value="<?php
                                                                                if (isset($errores["opcion4"])) {
                                                                                    echo "";
                                                                                } else if (isset($_POST["opcion4"])) {
                                                                                    echo $_POST["opcion4"];
                                                                                } else {
                                                                                    echo "";
                                                                                }
                                                                                ?>" />
                        <?php
                        if (isset($errores["opcion4"])) {
                            echo "<p class='error'>" . $errores["opcion4"] . "</p>";
                        }
                        ?>
                    </td>
                    <td id="tdRadio">
                        <input type="radio" name="correcta" id="correcta4" value="4" />
                        <label for="radio4">Correcta</label>
                        <?php
                        if (isset($errores["correcta"])) {
                            echo "<p class='error'>" . $errores["correcta"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="archivo">Archivo complementario:</label>
                    </td>
                </tr>
                <tr>
                    <td id="tdArchivo">
                        <input type="file" name="archivo" id="archivo" />
                        <?php
                        if (isset($errores["archivo"])) {
                            echo "<p class='error'>" . $errores["archivo"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="enviar" id="enviar" value="Crear" />
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
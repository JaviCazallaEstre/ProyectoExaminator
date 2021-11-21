<?php
include_once('../entidades/preguntaObjeto.php');
include_once('../entidades/respuestasObjeto.php');
include_once('../gestion/sesion.php');
Session::inicia();
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

    if (count($errores) == 0) {
        $opcion1 = new Respuesta(null, $_POST["opcion1"], null);
        $opcion2 = new Respuesta(null, $_POST["opcion2"], null);
        $opcion3 = new Respuesta(null, $_POST["opcion3"], null);
        $opcion4 = new Respuesta(null, $_POST["opcion4"], null);
        $opciones = array();
        array_push($opciones, $opcion1, $opcion2, $opcion3, $opcion4);
        if (isset($_FILES["archivo"])) {
            $pregunta = new Pregunta(null, $_POST["enunciado"], $opciones, $_FILES["archivo"], null, null);
        } else {
            $pregunta = new Pregunta(null, $_POST["enunciado"], $opciones, null, null, null);
        }
    }
}
function rellenaSelect(array $tematicas=null)
{
    # code...
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea pregunta</title>
</head>

<body>
    <form id="formu" name="formu" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <label for="tematica">Tem&aacute;tica:</label>
                </td>
            </tr>
            <tr>
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
                                                                        ?>">
                    </textarea>
                    <?php
                    if (isset($errores["enunciado"])) {
                        echo "<p class='error'>" . $errores["enunciado"] . "</p>";
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
                <td>
                    <input type="file" name="archivo" id="archivo" />
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
                    <input type="radio" id="correcta1" name="correcta" value="correcta1" />
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
                    <input type="radio" id="correcta2" name="correcta" value="correcta2" />
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
                    <input type="radio" id="correcta3" name="correcta" value="correcta3" />
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
                    <input type="radio" name="correcta" id="correcta4" value="correcta4" />
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
                    <input type="submit" name="enviar" id="enviar" value="Crear" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
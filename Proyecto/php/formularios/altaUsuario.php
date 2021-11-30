<?php
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
require_once("../cargadores/cargarGestion.php");
if (isset($_POST["enviar"])) {
    $errores = array();
    if ($_POST["email"] == "") {
        $errores["email"] = "Debes de introducir un email";
    } else if (!($_POST["email"] == filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {
        $errores["email"] = "El email introducido no es v&aacute;lido";
    }
    if ($_POST["fecha"] == "") {
        $errores["fecha"] = "El campo fecha debe de estar relleno";
    } else if (!(validateDateEs($_POST["fecha"]))) {
        $errores["fecha"] = "El campo fecha no es v&aacute;lido";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Alta usuario</title>
    <script src="../../js/altaUsuario.js"></script>
    <script src="../../js/libreria/prototiposString.js"></script>
    <script src="../../js/libreria/metodos.js"></script>
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <form>
        <table>
            <tr>
                <td>
                    <label for="correo">Correo electr&oacute;nico:</label>
                </td>
                <td>
                    <input type="text" name="correo" id="correo" value="<?php
                                                                        if (isset($errores["email"])) {
                                                                            echo "";
                                                                        } else if (isset($_POST["email"])) {
                                                                            echo $_POST["email"];
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        ?>" />
                    <?php
                    if (isset($errores["email"])) {
                        echo "<p class='error'>" . $errores["email"] . "</p>";
                    }
                    ?>

                </td>
            </tr>
            <tr>
                <td>
                    <label for="fecha">Fecha de expiraci&oacute;n:</label>
                </td>
                <td>
                    <input type="date" name="fecha" id="fecha" value="<?php
                                                                        if (isset($errores["fecha"])) {
                                                                            echo "";
                                                                        } else if (isset($_POST["fecha"])) {
                                                                            echo $_POST["fecha"];
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        ?>" />
                    <?php
                    if (isset($errores["fecha"])) {
                        echo "<p class='error'>" . $errores["fecha"] . "</p>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="enviar" id="evniar" value="Enviar" />
                </td>
            </tr>
        </table>
    </form>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
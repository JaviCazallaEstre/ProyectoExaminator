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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/altaUsuario.css" />
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <div class="contenido">
        <form>
            <table>
                <tr>
                    <td>
                        <label for="correo">Correo electr&oacute;nico:</label>
                    </td>
                    <td id="tdEmail">
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
                        <input type="submit" name="enviar" id="enviar" value="Enviar" />
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
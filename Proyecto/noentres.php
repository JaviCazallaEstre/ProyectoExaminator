<?php
require_once("php/cargadores/cargarBD.php");
require_once("php/cargadores/cargarclases.php");
require_once("php/cargadores/cargarGestion.php");
$errores = array();
if (isset($_POST["enviar"])) {
    if ($_POST["email"] != "" && $_POST["contrasena"] != "") {
        $usuario = Login::existeUsuario($_POST["email"], $_POST["contrasena"]);
        if ($usuario != false) {
            Session::inicia();
            Session::escribir("usuario", $usuario);
            if ($_POST["recuerdame"] == 'on') {
                setcookie("usuario", $_POST["email"], time() + 3600);
                setcookie("contrasena", $_POST["contrasena"], time() + 3600);
                setcookie("recuerdame", $_POST["recuerdame"], time() + 3600);
            }
        } else {
            $errores["login"] = "Los datos introducidos son incorrectos";
        }
    } else {
        $errores["login"] = "Los campos deben de estar rellenos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <title>Iniciar sesion</title>
</head>
<header>
    <div class='logo'><img src='Recursos/Autoescuela-A7-00.png' />
        <h1>Autoescuela Javi</h1>
    </div>
</header>

<body>
    <div class="contenido">
        <form id="formulario" method="POST">
            <table>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="email" name="email" value='<?php
                                                                            if (isset($_COOKIE)) {
                                                                                if (isset($_COOKIE["usuario"]) && isset($_COOKIE["contrasena"])) {
                                                                                    echo $_COOKIE["usuario"];
                                                                                }
                                                                            }
                                                                            ?> ' />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="contrasena">Contrase&ntilde;a:</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" id="contrasena" name="contrasena" value='<?php
                                                                                        if (isset($_COOKIE)) {
                                                                                            if (isset($_COOKIE["usuario"]) && isset($_COOKIE["contrasena"])) {
                                                                                                echo $_COOKIE["contrasena"];
                                                                                            }
                                                                                        }
                                                                                        ?>' />
                    </td>
                    <td>
                        <label for="recuerdame">Recuerdame</label>
                        <input type="checkbox" id="recuerdame" name="recuerdame" <?php
                                                                                    if (isset($_COOKIE["recuerdame"]) == 'on') {
                                                                                        echo "checked";
                                                                                    } else {
                                                                                        unset($_COOKIE);
                                                                                    }
                                                                                    ?> />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if (isset($errores["login"])) {
                            echo "<p class='error'>" . $errores["login"] . "</p>";
                        }
                        ?>
                    </td>
                    <td>
                        <input type="submit" id="enviar" name="enviar" value="Iniciar sesión" />
                    </td>
                </tr>
            </table>
        </form>
        <a href="">¿Has olvidado tu contraseña</a>
    </div>
</body>

</html>
<?php
include_once("php/gestion/BD.php");
BD::creaConexion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
</head>

<body>
    <div>
        <form id="formulario" method="POST">
            <table>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="email" name="email" value=<?php
                                                                            if (isset($_COOKIE)) {
                                                                                if (isset($_COOKIE["usuario"]) && isset($_COOKIE["contrasena"])) {
                                                                                    echo $_COOKIE["usuario"];
                                                                                }
                                                                            }
                                                                            ?> />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="contrasena">Contrase&ntilde;a:</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" id="contrasena" name="contrasena" value=<?php
                                                                                        if (isset($_COOKIE)) {
                                                                                            if (isset($_COOKIE["usuario"]) && isset($_COOKIE["contrasena"])) {
                                                                                                echo $_COOKIE["contrasena"];
                                                                                            }
                                                                                        }
                                                                                        ?> />
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
                        <input type="submit" id="enviar" name="enviar" value="Iniciar sesión" />
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST)) {
            if ($_POST["email"] != "" && $_POST["contrasena"] != "") {
                if (bd::existeUsuario($_POST["email"], $_POST["contrasena"])) {
                    Session::inicia();
                    Session::escribir("usuario", $_POST["email"]);
                    Session::escribir("contrasena", $_POST["contrasena"]);
                    if ($_POST["recuerdame"] == 'on') {
                        setcookie("usuario", $_POST["email"], time() + 3600);
                        setcookie("contrasena", $_POST["contrasena"], time() + 3600);
                        setcookie("recuerdame", $_POST["recuerdame"], time() + 3600);
                    }
                } else {
                    echo "<p class='error'>Los datos introducidos son incorrectos</p>";
                }
            } else {
                echo "<p class='error'>Los campos deben de estar rellenos</p>";
            }
        }
        ?>
        <a href="">¿Has olvidado tu contraseña</a>
        <a href="">Nueva cuenta de usuario</a>
    </div>
</body>

</html>
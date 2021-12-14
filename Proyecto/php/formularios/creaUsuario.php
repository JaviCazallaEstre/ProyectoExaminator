<?php
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
require_once("../cargadores/cargarGestion.php");
Session::inicia();
if (isset($_GET["modo"])) {
    if ($_GET["modo"] == "modifica") {
        $usuario = BdUsuario::sacaUsuarioId($_GET["id"]);
    }
}
function validateDateEs($date)
{
    $pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
    if (preg_match($pattern, $date)) {
        $values = preg_split("[\/|-]", $date);
        if (checkdate($values[1], $values[2], $values[0]))
            return true;
    }
    return false;
}
function getAge($fecha)
{
    //Creamos objeto fecha desde los valores recibidos
    $nacio = DateTime::createFromFormat('Y-m-d', $fecha);
    //Calculamos usando diff y la fecha actual
    $calculo = $nacio->diff(new DateTime());
    //Obtenemos la edad
    $edad =  $calculo->y;
    return $edad;
}
if (isset($_POST["crear"])) {
    $errores = array();
    if ($_POST["email"] == "") {
        $errores["email"] = "Debes de introducir un email";
    } else if (!($_POST["email"] == filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {
        $errores["email"] = "El email introducido no es v&aacute;lido";
    }
    if ($_POST["nombre"] == "") {
        $errores["nombre"] = "El campo nombre no puede estar vac&iacute;o";
    } else if (preg_match("*[0-9]*", $_POST["nombre"])) {
        $errores["nombre"] = "El campo nombre no puede tener n&uacute;meros";
    }
    if ($_POST["apellidos"] == "") {
        $errores["apellidos"] = "El campo de los apellidos no puede estar vac&iacute;o";
    } else if (preg_match("*[0-9]*", $_POST["apellidos"])) {
        $errores["apellidos"] = "El campo de los apellidos no puede tener n&uacute;meros";
    }
    if ($_POST["contrasena"] == "") {
        $errores["contrasena"] = "La contrase&ntilde;a debe de estar rellena";
    }
    if ($_POST["contrasenaIgual"] == "") {
        $errores["contrasenaIgual"] = "El confirmar contrase&ntilde;a debe de estar relleno";
    } else if ($_POST["contrasena"] != $_POST["contrasenaIgual"]) {
        $errores["contrasenaIgual"] = "Las contrase&ntilde;as no coinciden deben de ser iguales";
    }
    if ($_POST["fecha"] == "") {
        $errores["fecha"] = "El campo fecha debe de estar relleno";
    } else if (!(validateDateEs($_POST["fecha"]))) {
        $errores["fecha"] = "El campo fecha no es v&aacute;lido";
    } else if (getAge($_POST["fecha"]) < 18) {
        $errores["fecha"] = "Debe de ser mayor de 18 años";
    }
    if (isset($_FILES["foto"])) {
        $permitidos = array("image/png", "image/jpeg", "image/jpg", "image/gif");
        $limiteKb = 200;
        if (in_array($_FILES["foto"]["type"], $permitidos) && $_FILES["foto"]["size"] <= $limiteKb * 1024) {
            $ruta = "../../Recursos/Usuarios/" . $_FILES["foto"]["name"];
            move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
        } else if (!in_array($_FILES["foto"]["type"], $permitidos)) {
            $errores["foto"] = "La foto introducida no tiene un formato válido";
        } else {
            $errores["foto"] = "La foto introducida supera el límite de peso permitido (200KB)";
        }
    }
    if (count($errores) == 0) {
        if (isset($_FILES["foto"])) {
            $usuario = new Usuario($_POST["id"], $_POST["email"], $_POST["nombre"], $_POST["apellidos"], $_POST["contrasena"], $_POST["fecha"], $_FILES["foto"]["name"], new Rol(2, "estudiante"));
        } else {
            $usuario = new Usuario($_POST["id"], $_POST["email"], $_POST["nombre"], $_POST["apellidos"], $_POST["contrasena"], $_POST["fecha"], null, new Rol(2, "estudiante"));
        }
        if ($_POST["modo"] == "inserta") {
            if (bdAltaUsuario::comparaHash($_POST["id"], $_POST["hash"])) {
                BdUsuario::insertaBD($usuario);
                $usuarioCreado = Login::existeUsuario($_POST["email"], $_POST["contrasena"]);
                Session::escribir("usuario", $usuarioCreado);
                Session::escribir("rol", $usuarioCreado->rol->id);
                header("Location: ../principal.php");
            }
        } else if ($_POST["modo"] == "modifica") {

            BdUsuario::modificaUsuarioSinRol($usuario);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea usuario</title>
    <script src="../../js/creaUsuario.js"></script>
    <script src="../../js/libreria/prototiposString.js"></script>
    <script src="../../js/libreria/metodos.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/creaUsuario.css" />
</head>

<body>
    <header>
        <div class='logo'><img src='../../Recursos/Autoescuela-A7-00.png' />
            <h1>Autoescuela Javi</h1>
        </div>
    </header>
    <div class="contenido">
        <h1>Alta de usuario</h1>
        <form id="formu" name="formu" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                    <td id="tdEmail">
                        <input type="text" id="email" name="email" readonly value="<?php
                                                                                    if (isset($_GET["modo"])) {
                                                                                        if ($_GET["modo"] == "modifica") {
                                                                                            echo $usuario->email;
                                                                                        } else {
                                                                                            echo $_GET["correo"];
                                                                                        }
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
                        <label for="nombre">Nombre:</label>
                    </td>
                    <td id="tdNombre">
                        <input type="text" id="nombre" name="nombre" value="<?php
                                                                            if (isset($_GET["modo"])) {
                                                                                if ($_GET["modo"] == "modifica") {
                                                                                    echo $usuario->nombre;
                                                                                }
                                                                            } else if (isset($errores["nombre"])) {
                                                                                echo "";
                                                                            } else if (isset($_POST["nombre"])) {
                                                                                echo $_POST["nombre"];
                                                                            } else {
                                                                                echo "";
                                                                            }
                                                                            ?>" />
                        <?php
                        if (isset($errores["nombre"])) {
                            echo "<p class='error'>" . $errores["nombre"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="apellidos">Apellidos:</label>
                    </td>
                    <td id="tdApellidos">
                        <input type="text" id="apellidos" name="apellidos" value="<?php
                                                                                    if (isset($_GET["modo"])) {
                                                                                        if ($_GET["modo"] == "modifica") {
                                                                                            echo $usuario->apellidos;
                                                                                        }
                                                                                    } else if (isset($errores["apellidos"])) {
                                                                                        echo "";
                                                                                    } else if (isset($_POST["apellidos"])) {
                                                                                        echo $_POST["apellidos"];
                                                                                    } else {
                                                                                        echo "";
                                                                                    }
                                                                                    ?>" />
                        <?php
                        if (isset($errores["apellidos"])) {
                            echo "<p class='error'>" . $errores["apellidos"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="contrasena">Contrase&ntilde;a:</label>
                    </td>
                    <td id="tdContrasena">
                        <input type="password" id="contrasena" name="contrasena" value="<?php
                                                                                        if (isset($_GET["modo"])) {
                                                                                            if ($_GET["modo"] == "modifica") {
                                                                                                echo $usuario->contrasena;
                                                                                            }
                                                                                        } else if (isset($errores["contrasena"]) || isset($errores["contrasenaIgual"])) {
                                                                                            echo "";
                                                                                        } else if (isset($_POST["contrasena"])) {
                                                                                            echo $_POST["contrasena"];
                                                                                        } else {
                                                                                            echo "";
                                                                                        }
                                                                                        ?>" />
                        <?php
                        if (isset($errores["contrasena"])) {
                            echo "<p class='error'>" . $errores["contrasena"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="contrasenaIgual">Confirmar contrase&ntilde;a:</label>
                    </td>
                    <td id="tdContrasenaIgual">
                        <input type="password" id="contrasenaIgual" name="contrasenaIgual" value="<?php
                                                                                                    if (isset($_GET["modo"])) {
                                                                                                        if ($_GET["modo"] == "modifica") {
                                                                                                            echo $usuario->contrasena;
                                                                                                        }
                                                                                                    } else if (isset($errores["contrasena"]) || isset($errores["contrasenaIgual"])) {
                                                                                                        echo "";
                                                                                                    } else if (isset($_POST["contrasenaIgual"])) {
                                                                                                        echo $_POST["contrasenaIgual"];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    }
                                                                                                    ?>" />
                        <?php
                        if (isset($errores["contrasenaIgual"])) {
                            echo "<p class='error'>" . $errores["contrasenaIgual"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="fecha">Fecha de nacimiento:</label>
                    </td>
                    <td id="tdFecha">
                        <input type="date" id="fecha" name="fecha" placeholder="dd/mm/yyyy" value="<?php
                                                                                                    if (isset($_GET["modo"])) {
                                                                                                        if ($_GET["modo"] == "modifica") {
                                                                                                            echo $usuario->fecha_nac;
                                                                                                        }
                                                                                                    } else if (isset($errores["fecha"])) {
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
                        <label for="foto">Foto de perfil:</label>
                    </td>
                    <td id="tdFoto">
                        <input type="file" id="foto" name="foto" value="<?php
                                                                        if (isset($_GET["modo"])) {
                                                                            if ($_GET["modo"] == "modifica") {
                                                                                echo $usuario->foto;
                                                                            }
                                                                        }
                                                                        ?>" />
                        <?php
                        if (isset($errores["foto"])) {
                            echo "<p class='error'>" . $errores["foto"] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" id="crear" name="crear" value="<?php
                                                                            if (isset($_GET["modo"])) {
                                                                                if ($_GET["modo"] == "modifica") {
                                                                                    echo "Modificar";
                                                                                } else {
                                                                                    echo "Crear";
                                                                                }
                                                                            } else {
                                                                                echo "Crear";
                                                                            }
                                                                            ?>" />
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
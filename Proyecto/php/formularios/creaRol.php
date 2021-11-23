<?php
include_once("../entidades/rolObjeto.php");
include_once("../gestion/BD.php");
include_once("../gestion/sesion.php");
if (isset($_POST["crear"])) {
    $errores = array();
    if ($_POST["nombre"] == "") {
        $errores["nombre"] = "El campo de nombre debe de estar relleno";
    }
    if (count($errores) == 0) {
        $rol = new Rol(null, $_POST["nombre"]);
        bd::insertaRol($rol);
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
</head>
<body>
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
</body>
</html>
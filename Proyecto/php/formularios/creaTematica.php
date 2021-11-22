<?php
include_once("../entidades/tematicaObjeto.php");
if(isset($_POST["crear"])){
    $errores=array();
    if($_POST["nombre"]==""){
        $errores["nombre"]="El campo de nombre debe de estar relleno";
    }
    if(count($errores)==0){
        $tematica= new Tematica(null,$_POST["nombre"]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tematica</title>
    <script src="../../js/creaTematica.js"></script>
</head>

<body>
    <form id="formu" method="POST" name="formu">
        <table>
            <tr>
                <td>
                    <label for="nombre">Nombre: *</label>
                </td>
                <td>
                    <input type="text" id="nombre" name="nombre" />
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
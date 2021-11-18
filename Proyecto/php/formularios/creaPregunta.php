<?php
if(isset($_POST["enviar"])){
    $errores=array();
    if($_POST["enunciado"]==""){
        $errores["enunciado"]="El enunciado debe de estar relleno";
    }
    if($_POST["opcion1"]==""){
        $errores["opcion1"]=="la primera opcion debe de estar rellena";
    }
    if($_POST["opcion2"]==""){
        
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
                <td>
                    <select id="tematica" name="tematica">
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="enunciado">Enunciado:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <textarea id="enunciado" name="enunciado"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="archivo">Archivo complementario:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="file" name="archivo" id="archivo"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="opcion1">Opci&oacute;n 1:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="opcion1" name="opcion1"/>
                </td>
                <td>
                    <input type="radio" id="correcta" name="correcta"/>
                    <label for="radio1">Correcta</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="opcion2">Opci&oacute;n 2:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="correcta" name="correcta"/>
                    <label for="radio2">Correcta</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="opcion3">Opci&oacute;n 3</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="correcta" name="correcta"/>
                    <label for="radio3">Correcta</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="opcion4">Opci&oacute;n 4:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="correcta" id="correcta"/>
                    <label for="radio4">Correcta</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="enviar" id="enviar" value="Crear"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
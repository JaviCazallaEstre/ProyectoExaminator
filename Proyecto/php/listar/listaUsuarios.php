<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
Session::inicia();
if(!Session::usuarioLogueado("usuario")){
    echo "nada";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <title>Lista usuarios</title>
</head>

<body>
    <header>
    </header>
    <div id="contenido">
        <div id="formularios">
            <form action="http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/altaUsuario.php">
                <input type="submit" value="Alta usuario" />
            </form>
            <form action="http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/altaMasivaUsuario.php">
                <input type="submit" value="Alta masiva usuario" />
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    
                </tr>
        </table>
    </div>
    <footer>

    </footer>
</body>

</html>
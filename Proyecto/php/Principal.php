<?php
require_once("cargadores/cargarGestion.php");
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
    <link rel="stylesheet" type="text/css" href="../css/principal.css" />
    <script src="../js/parallax.js"></script>
    <title>Autoescuela Javi</title>
</head>

<body>
    <header>
        <div class='logo'><img src='../Recursos/Autoescuela-A7-00.png' />
            <h1>Autoescuela Javi</h1>
        </div>
        <div class='fotoUsuario'><img src='' /></div>
        <div id='menu'>
            <ul>
                <li>
                    <a href='#'>Usuarios</a>
                    <ul class='submenu'>
                        <li>
                            <a href='formularios/altaUsuario.php'>Alta usuario</a>
                        </li>
                        <li>
                            <a href='formularios/altaMasivaUsuario.php'>Alta masiva</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Tem&aacute;tica</a>
                    <ul class='submenu'>
                        <li>
                            <a href='formularios/creaTematica.php'>Alta tem&aacute;tica</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Preguntas</a>
                    <ul class='submenu'>
                        <li>
                            <a href='formularios/creaPregunta.php'>Alta pregunta</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Ex&aacute;menes</a>
                    <ul class='submenu'>
                        <li>
                            <a href='formularios/creaExamen.php'>Alta examen</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <div class="contenido">
        <div id="parallax">
            <h1>Bienvenido a la Autoescuela Javi</h1>
        </div>
        <div>
            <p>
                Este es el sitio web de Autoescuela Javi en esta web podr&aacute;s preparar tu
                te&oacute;rico mediante nuestros ex&aacute;menes donde pondr&aacute;s a prueba tus
                concocimientos y te garantizamos el salir preparado al examen de la DGT mediante 
                nuestros propios ex&aacute;menes. Contamos con una tasa del 95% de aprobados al primer
                intento el porcentaje m&aacute;s alto de Ja&eacute;n.
            </p>
        </div>
        <div></div>
    </div>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
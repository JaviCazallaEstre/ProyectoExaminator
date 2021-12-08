<?php
require_once("cargadores/cargarGestion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <a href='#'>Alta usuario</a>
                        </li>
                        <li>
                            <a href='#'>Alta masiva</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Tem&aacute;tica</a>
                    <ul class='submenu'>
                        <li>
                            <a href='#'>Alta tem&aacute;tica</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Preguntas</a>
                    <ul class='submenu'>
                        <li>
                            <a href='#'>Alta pregunta</a>
                        </li>
                        <li>
                            <a href='#'>Alta masiva</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Ex&aacute;menes</a>
                    <ul class='submenu'>
                        <li>
                            <a href='#'>Alta examen</a>
                        </li>
                        <li>
                            <a href='#'>Historico</a>
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
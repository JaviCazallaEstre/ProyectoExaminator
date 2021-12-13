<?php
class CreaCabecera
{
    public static function creaCabeceraAlumno()
    {
        echo "<div class='logo'><img src='../../Recursos/Autoescuela-A7-00.png'/>
        <h1>Autoescuela Javi</h1>
        </div>";
        echo "<div class='fotoUsuario'><img src=''/></div>";
        echo
        "<div>
    <ul>
        <li>
            <a href='#'>Hist&oacute;rico de ex&aacute;menes</a>
        </li>
        <li>
            <a href='#'>Examen predefinido</a>
        </li>
        <li>
            <a href='#'>Examen aleatorio</a>
        </li>
    </ul>
</div>";
    }
    public static function creaCabeceraProfesor()
    {
        echo "<div class='logo'><img src='../../Recursos/Autoescuela-A7-00.png'/>
        <h1>Autoescuela Javi</h1>
        </div>";
        echo "<div class='fotoUsuario'><img src=''/></div>";
        echo
        "<div id='menu'>
            <ul>
                <li>
                    <a href='../listar/listaUsuarios.php'>Usuarios</a>
                    <ul class='submenu'>
                        <li>
                            <a href='../formularios/altaUsuario.php'>Alta usuario</a>
                        </li>
                        <li>
                            <a href='../formularios/altaMasivaUsuario.php'>Alta masiva</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='../listar/listaTematicas.php'>Tem&aacute;tica</a>
                    <ul class='submenu'>
                        <li>
                            <a href='../formularios/creaTematica.php'>Alta tem&aacute;tica</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='../listar/listaPreguntas.php'>Preguntas</a>
                    <ul class='submenu'>
                        <li>
                            <a href='../formularios/creaPregunta.php'>Alta pregunta</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Ex&aacute;menes</a>
                    <ul class='submenu'>
                        <li>
                            <a href='../formularios/creaExamen.php'>Alta examen</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>";
    }
}

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
        </div>";
    }
}

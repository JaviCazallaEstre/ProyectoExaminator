<?php
function creaFooter($guia, $mapa)
{
    echo
    "<div class='columna1'>
    <ul>
        <li>
            <a href='" . $guia . "'>Guia de estilo</a>
        </li>
        <li>
            <a href='" . $mapa . "'>Mapa web del sitio</a>
        </li>
    </ul>
</div>";
    echo
    "<div class='columna2'>
    <p>Enlaces relacionados</p>
    <ul>
        <li>
            <a href='https://www.dgt.es/inicio/'>DGT</a>
        </li>
        <li>
            <a href='https://sede.dgt.gob.es/es/permisos-de-conducir/obtencion-renovacion-duplicados-permiso/permiso-conducir/index.shtml'>Solicitud oficial de examen</a>
        </li>
        <li>
            <a href='https://www.dgt.es/muevete-con-seguridad/conoce-las-normas-de-trafico/'>Normativa examen</a>
        </li>
    </ul>
</div>";
    echo
    "<div class='columna3'>
    <p>Contacto</p>
    <ul>
        <li>
            Tel&eacute;fono: 953111222
        </li>
        <li>
            email: info@examinator.es
        </li>
        <li>
            Redes sociales
        </li>
    </ul>
</div>";
}

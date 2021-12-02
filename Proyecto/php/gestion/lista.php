<script src="../../js/lista.js"></script>
<table>
    <thead>

    </thead>
    <tbody>

    </tbody>
</table>
<a href="?p=Listados/lista&t=persona" class="links">
    <span class="span first">
        <i class="icon fa fa-users" ariaa-hidden="true"></i>
    </span>Usuarios
</a>
<?php
isset($_GET["t"]) ? Session::escribir("tabla", $_GET["t"]) : Session::escribir("tabla", "persona");

<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
$roles=BdRol::sacaRoles();
echo json_encode($roles);
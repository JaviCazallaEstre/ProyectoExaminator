<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
$tematicas=BdTematica::sacaTematicas();
echo json_encode($tematicas);
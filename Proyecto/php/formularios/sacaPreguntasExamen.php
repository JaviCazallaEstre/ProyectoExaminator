<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
$pregunta=BdPregunta::sacaPregunta($_GET["idPregunta"]);
echo json_encode($pregunta);
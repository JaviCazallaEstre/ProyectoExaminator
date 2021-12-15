<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
$respuestas=BdPregunta::sacaRespuestasPregunta($_GET["idPregunta"]);
echo json_encode($respuestas);
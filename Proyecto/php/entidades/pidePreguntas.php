<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
$preguntas=BdPregunta::sacaPreguntas();
echo json_encode($preguntas);

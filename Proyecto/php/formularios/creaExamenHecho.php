<?php
require_once("../cargadores/cargarGestion.php");
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
Session::inicia();
if (!Session::usuarioLogueado("usuario")) {
    echo "nada";
}
if (isset($_POST["finalizar"])) {
    $examen = new ExamenHecho(null, null, $_POST["respuestas"], $_POST["idExamen"], $_POST["idUsuario"]);
    BdExamenHecho::insertaExamen($examen);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/creaExamenHecho.css" />
    <script src="../../js/creaExamenHecho.js"></script>
    <title>Realiza examen</title>
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraAlumno();
        ?>
    </header>
    <form id="formulario" name="formulario" method="POST">
        <div id="contenido">
            <div id="pregunta">
                <h2>Pregunta 1</h2>
            </div>
            <div id="foto">
                <img src="../../Recursos/foto-principal-2.jpg" />;
            </div>
            <div id="enunciado">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam
                    velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate
                    commodo lectus, ac blandit elit tincidunt id. Sed rhoncus, tortor sed
                    eleifend tristique, tortor mauris molestie elit, et lacinia ipsum quam
                    nec dui.
                </p>
            </div>
            <div id="opciones">
                <label>Opcion1</label>
                <input type="radio" name="correcta" id="opcion1" />
                <label>Opcion2</label>
                <input type="radio" name="correcta" id="opcion2" />
                <label>Opcion3</label>
                <input type="radio" name="correcta" id="opcion3" />
                <label>Opcion4</label>
                <input type="radio" name="correcta" id="opcion4" />
            </div>
            <div id="botones">
                <input type="button" name="atras" id="atras" value="Atrás" />
                <input type="button" name="siguiente" id="siguiente" value="Siguiente" />
                <input type="submit" name="finalizar" id="finalizar" value="Finalizar" />
            </div id>
            <div id="eligePregunta">
                <div>
                    <p>1</p>
                </div>
                <div>
                    <p>2</p>
                </div>
                <div>
                    <p>3</p>
                </div>
                <div>
                    <p>4</p>
                </div>
                <div>
                    <p>5</p>
                </div>
                <div>
                    <p>6</p>
                </div>
                <div>
                    <p>7</p>
                </div>
                <div>
                    <p>8</p>
                </div>
                <div>
                    <p>9</p>
                </div>
                <div>
                    <p>10</p>
                </div>
                <div>
                    <p>11</p>
                </div>
                <div>
                    <p>12</p>
                </div>
                <div>
                    <p>13</p>
                </div>
                <div>
                    <p>14</p>
                </div>
                <div>
                    <p>15</p>
                </div>
                <div>
                    <p>16</p>
                </div>
                <div>
                    <p>17</p>
                </div>
                <div>
                    <p>18</p>
                </div>
                <div>
                    <p>19</p>
                </div>
                <div>
                    <p>20</p>
                </div>
                <div>
                    <p>21</p>
                </div>
                <div>
                    <p>22</p>
                </div>
                <div>
                    <p>23</p>
                </div>
                <div>
                    <p>24</p>
                </div>
                <div>
                    <p>25</p>
                </div>
                <div>
                    <p>26</p>
                </div>
                <div>
                    <p>27</p>
                </div>
                <div>
                    <p>28</p>
                </div>
                <div>
                    <p>29</p>
                </div>
                <div>
                    <p>30</p>
                </div>
            </div>
        </div>
    </form>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
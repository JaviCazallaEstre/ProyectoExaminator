<?php
require_once("../cargadores/cargarBD.php");
require_once("../cargadores/cargarclases.php");
require_once("../cargadores/cargarGestion.php");
require_once("../gestion/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["enviar"])) {
    $errores = array();
    if ($_POST["correo"] == "") {
        $errores["correo"] = "Debes de introducir un email";
    } else if (!($_POST["correo"] == filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL))) {
        $errores["correo"] = "El email introducido no es v&aacute;lido";
    } else if (!BdUsuario::existeUsuario($_POST["correo"])) {
        $valor = rand(0, 500000000000);
        $fecha = date(DATE_RFC2822);
        $hash = md5($valor . $fecha);
        //BdUsuario::insertaAlta(null,$_POST["correo"]);
        //bdAltaUsuario::insertaAlta(null,$hash,$_POST["correo"]);
        $alta = BdUsuario::sacaUsuario($_POST["correo"]);
        $id = $alta->id;
        $correo = $alta->correo;

        $mail = new PHPMailer();
        $mail->IsSMTP();
        // cambiar a 0 para no ver mensajes de error
        $mail->SMTPDebug  = 2;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        // introducir usuario de google
        $mail->Username   = "javiCazallaPruebas@gmail.com";
        // introducir clave
        $mail->Password   = "@Maceta12";
        $mail->SetFrom('javiCazallaPruebas@gmail.com', 'Autoescuela Javi');
        // asunto
        $mail->Subject = "Completa tu registro";
        // cuerpo
        $mail->MsgHTML("<a href='http://proyectos/Proyecto/ProyectoExaminator/Proyecto/php/formularios/creaUsuario.php?modo=inserta&hash=" . $hash . "&id=" . $id . "&correo=" . $correo . "'>Pincha aqui</a>");
        // destinatario
        $address = $_POST["correo"];
        $mail->AddAddress($address, "Completa tu registro");
        // enviar
        $resul = $mail->Send();
        if (!$resul) {
            echo "Error" . $mail->ErrorInfo;
        } else {
            echo "Enviado";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Alta usuario</title>
    <script src="../../js/altaUsuario.js"></script>
    <script src="../../js/libreria/prototiposString.js"></script>
    <script src="../../js/libreria/metodos.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/altaUsuario.css" />
</head>

<body>
    <header>
        <?php
        CreaCabecera::creaCabeceraProfesor();
        ?>
    </header>
    <div class="contenido">
        <form>
            <table>
                <tr>
                    <td>
                        <label for="correo">Correo electr&oacute;nico:</label>
                    </td>
                    <td id="tdEmail">
                        <input type="text" name="correo" id="correo" value="<?php
                                                                            if (isset($errores["email"])) {
                                                                                echo "";
                                                                            } else if (isset($_POST["email"])) {
                                                                                echo $_POST["email"];
                                                                            } else {
                                                                                echo "";
                                                                            }
                                                                            ?>" />
                        <?php
                        if (isset($errores["email"])) {
                            echo "<p class='error'>" . $errores["email"] . "</p>";
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="enviar" id="enviar" value="Enviar" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <footer>
        <?php
        CreaFooter::creaFooterPagina("", "");
        ?>
    </footer>
</body>

</html>
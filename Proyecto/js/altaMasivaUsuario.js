window.addEventListener("load", function () {
  const formulario = document.getElementById("formu");
  const enviar = document.getElementById("enviar");
  var textArea = document.getElementById("textarea");
  var archivo = document.getElementById("archivo");

  enviar.onclick(function (ev) {
    ev.preventDefault();
    errores = validaAltaMasiva(textArea.value, archivo);
    if (Object.keys(errores).length > 0) {
      escribeErrores(errores);
    } else {
      if (textArea.value != "") {
        altas = textArea.value.split("/n");
        for (let i = 0; i < altas.length; i++) {
          formulario = new FormData();
          formulario.append("enviar", "");
          formulario.append("email", altas[i]);
          const ajax = new XMLHttpRequest();
          ajax.open("POST", "altaUsuario.php");
          ajax.send(formulario);
        }
      }
    }
  });
  function validaAltaMasiva(textArea, archivo) {
    errores = [];
    if (textArea != "" && archivo.files[0] != "") {
      errores["duplicado"] = "Solo se puede rellenar un campo";
    } else if (textArea != "") {
      altas = textArea.value.split("/n");
      valido = true;
      for (let i = 0; i < altas.length; i++) {
        if (!altas[i].esEmail()) {
          valido = false;
        }
      }
      if (!valido) {
        errores["textArea"] = "Hay emails no válidos revise los emails";
      }
    }
    return errores;
  }
  function escribeErrores(errores) {
    const tdArchivo = document.getElementById("tdArchivo");
    const tdTextArea = document.getElementById("tdTextArea");
    if (errores.hasOwnProperty("duplicado")) {
      escribeErrores("duplicado", errores, tdArchivo);
    }
    if (errores.hasOwnProperty("textArea")) {
      escribeErrores("textArea", errores, tdTextArea);
    }
  }
});

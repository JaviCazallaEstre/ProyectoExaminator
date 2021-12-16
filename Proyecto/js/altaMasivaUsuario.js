window.addEventListener("load", function () {
  const formulario = document.getElementById("formu");
  const enviar = document.getElementById("enviar");
  var textArea = document.getElementById("textarea");
  var archivo = document.getElementById("archivo");

  enviar.onclick=function (ev) {
    ev.preventDefault();
    errores = validaAltaMasiva(textArea.value);
    debugger;
    if (Object.keys(errores).length > 0) {
      escribeErrores(errores);
    } else {
      if (textArea.value != "") {
        altas = textArea.value.split("\n");
        for (let i = 0; i < altas.length; i++) {
          debugger;
          let formu = new FormData();
          formu.append("enviar", "");
          formu.append("correo", altas[i]);
          const ajax = new XMLHttpRequest();
          ajax.open("POST", "altaUsuario.php");
          ajax.send(formu);
        }
      }
    }
  };
  archivo.addEventListener("change", (ev)=>{
    let file = ev.target.files[0];
    let reader = new FileReader();
    reader.onload = function(ev2){
    
        try {
            contenido = leerCSV(ev2.target.result,true);
            textArea.innerHTML=contenido;

        } catch (e) {
            console.log(`Error: ${e.message}`)
        }
    }

    reader.readAsText(file);
});
function leerCSV(texto,omitirEncabezado = false,separador=","){
    if(typeof texto !== "string"){
        throw TypeError("El argumento debe ser una cadena.")
    }
   return texto.slice(omitirEncabezado ? texto.indexOf('\n') + 1 : 0)
    .split('\n')
    .map(linea => linea.split(separador));
}
  function validaAltaMasiva(textArea) {
    errores = [];
    if (textArea != "") {
      altas = textArea.split("\n");
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
    const tdEmail = document.getElementById("tdEmail");
    const tdTextArea = document.getElementById("tdTextArea");
    if (errores.hasOwnProperty("duplicado")) {
      escribeErrores("duplicado", errores, tdEmail);
    }
    if (errores.hasOwnProperty("textArea")) {
      escribeErrores("textArea", errores, tdTextArea);
    }
  }
});

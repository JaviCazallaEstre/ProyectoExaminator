window.addEventListener("load", function () {
  finalizar = document.getElementById("finalizar");
  contenido = document.getElementById("contenido");
  tituloPregunta = document.getElementById("pregunta");
  foto = document.getElementById("foto");
  enunciado = document.getElementById("enunciado");
  opciones = document.getElementById("opciones");
  atras = document.getElementById("atras");
  siguiente = document.getElementById("siguiente");
  eligePregunta = document.getElementById("eligePregunta");

  finalizar.onclick = function (ev) {
    ev.preventDefault();
    let formu = new FormData();
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "creaExamenHecho.php");
    ajax.send(formu);
  };
});

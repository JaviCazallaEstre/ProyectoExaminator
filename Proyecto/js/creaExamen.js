window.addEventListener("load", function () {
  const formulario = document.getElementById("formu");
  const enviar = document.getElementById("enviar");
  var descripcion = document.getElementById("descripcion");
  var duracion = document.getElementById("duracion");
  var activo = document.getElementById("activo");
  var seleccionables = document.getElementById("seleccionables");
  var seleccionadas = document.getElementById("seleccionadas");

  const ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.readyState == 200) {
      var respuesta = JSON.parse(ajax.responseText);
      if (respuesta.preguntas.length > 0) {
        for (let i = 0; i < respuesta.preguntas.length; i++) {
          var div = crearContenido(respuesta.preguntas[i]);
          seleccionables.appendChild(div);
        }
      }
    }
  };
  ajax.open("GET", "");
  ajax.send();

  function crearContenido(pregunta) {
    const div1 = document.createElement("div");
    div1.className = pregunta.tematica;
    const div2 = document.createElement("div");
    div2.className = pregunta.tematica;
    div2.innerHTML = pregunta.tematica;
    const div3 = document.createElement("div");
    div3.className = "enunciado";
    div3.innerHTML = pregunta.enunciado;
    if (pregunta.recurso != null) {
      const div4 = document.createElement("div");
      imagen = new Image();
      imagen.src = "data:image/png;base64," + pregunta.rcurso;
      div4.className = "foto";
      div4.appendChild(imagen);
      div1.appendChild(div4);
    }
    return div1;
  }
});

window.addEventListener("load", function () {
  const formulario = document.getElementById("formu");
  const enviar = document.getElementById("enviar");
  var descripcion = document.getElementById("descripcion");
  var duracion = document.getElementById("duracion");
  var activo = document.getElementById("activo");
  var seleccionables = document.getElementById("seleccionables");
  var seleccionadas = document.getElementById("seleccionadas");
  const divs = seleccionables.getElementsByTagName("div");

  pidePreguntas();
  for (let i = 0; i < divs.length; i++) {
    divs[i].ondragstart = function (ev) {
      ev.dataTransfer.setData("text", ev.target.id);
    };
    divs[i].ondragover = function (ev) {
      ev.preventDefault();
    };
    divs[i].ondrop = function (ev) {
      ev.preventDefault();
      
      const id = ev.dataTransfer.getData("text");
      ev.target.parentNode.appendChild(document.getElementById(id));
      if ((ev.target.parentNode.id = "seleccionadas")) {
        const marcados = seleccionadas.getElementsByClassName("marcado");
        for (let j = 0; i < marcados.length; j++) seleccionables.appendChild(marcados[j]);
      }
      ev.stopPropagation();
    };
    divs[i].onclick = function () {
      this.classList.toggle("marcado");
    };
  }
  seleccionadas.ondragover = function (ev) {
    ev.preventDefault();
  };

  seleccionables.ondragover = function (ev) {
    ev.preventDefault();
  };
  seleccionadas.ondrop = function (ev) {
    ev.preventDefault();
    debugger;
    const id = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(id));
    const marcados = seleccionables.getElementsByClassName("marcado");
    debugger;
    for (let j = marcados.length - 1; j >= 0; j--) seleccionadas.appendChild(marcados[j]);
    ev.stopPropagation();
  };

  seleccionables.ondrop = function (ev) {
    ev.preventDefault();
    const id = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(id));
    const marcados = seleccionadas.getElementsByClassName("marcado");
    for (let j = marcados.length - 1; j >= 0; j--) seleccionables.appendChild(marcados[j]);
    ev.stopPropagation();
  };
  function pidePreguntas() {
    const ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      var respuesta = JSON.parse(ajax.responseText);
      if (respuesta.preguntas.length > 0) {
        for (let i = 0; i < respuesta.preguntas.length; i++) {
          var div = crearContenido(respuesta.preguntas[i]);
          seleccionables.appendChild(div);
        }
      }
    }
  }
  ajax.open("GET", "../../php/entidades/pidePreguntasPrueba.php");
  ajax.send();
  }
  

  function crearContenido(pregunta) {
    const div1 = document.createElement("div");
    div1.setAttribute("id","hola");
    div1.setAttribute("draggable","true");
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
    div1.appendChild(div2);
    div1.appendChild(div3);
    return div1;
  }
});

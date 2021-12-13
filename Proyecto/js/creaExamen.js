window.addEventListener("load", function () {
  const formulario = document.getElementById("formu");
  const crear = document.getElementById("crear");
  var descripcion = document.getElementById("descripcion");
  var duracion = document.getElementById("duracion");
  var activo = document.getElementById("activo");
  var seleccionables = document.getElementById("seleccionables");
  var seleccionadas = document.getElementById("seleccionadas");
  var idSeleccionadas = [];
  const divs = seleccionables.getElementsByTagName("div");

  crear.onclick = function (ev) {
    ev.preventDefault();
    errores = validaExamen(descripcion.value, duracion.value);
    if (Object.keys(errores).length > 0) {
      muestraErrores(errores);
    } else {
      let formu = new FormData();
      formu.append("crear", "");
      formu.append("descripcion", descripcion.value);
      formu.append("duracion", duracion.value);
      if (activo.checked) {
        valorActivo = 1;
      } else {
        valorActivo = 0;
      }
      formu.append("activo", valorActivo);
      idPreguntas=[];
      for(let i=0;i<idSeleccionadas.length;i++){
        id=idSeleccionadas[i].split(" ");
        idPreguntas.push(id[1]);
      }
      json = JSON.stringify(idPreguntas);
      formu.append("preguntas", json);
      const ajax = new XMLHttpRequest();
      ajax.open("POST", "creaExamen.php");
      ajax.send(formu);
    }
  };
  function validaExamen(descripcion, duracion) {
    errores = [];
    if (descripcion == "") {
      errores["descripcion"] = "Debe de haber una descripción";
    }
    if (duracion == "") {
      errores["descripcion"] = "Debe de haber una duración";
    }
    if (idSeleccionadas.length == 0) {
      errores["seleccionadas"] = "Debes elegir preguntas";
    }
    return errores;
  }
  function muestraErrores(errores) {
    const tdDescripcion = document.getElementById("tdDescripcion");
    const tdDuracion = document.getElementById("tdDuracion");
    const tdSeleccionadas = document.getElementById("tdSeleccionadas");
    if (errores.hasOwnProperty("descripcion")) {
      escribeErrores("descripcion", errores, tdDescripcion);
    }
    if (errores.hasOwnProperty("duracion")) {
      escribeErrores("duracion", errores, tdDuracion);
    }
    if (errores.hasOwnProperty("seleccionadas")) {
      escribeErrores("seleccionadas", errores, tdSeleccionadas);
    }
  }
  pidePreguntas();
  seleccionables.addEventListener("dragover", function () {
    event.preventDefault();
  });
  seleccionables.addEventListener("drop", function () {
    const id = event.dataTransfer.getData("id");
    seleccionables.appendChild(document.getElementById(id));
    idSeleccionadas = idSeleccionadas.filter((idGuardada) => idGuardada != id);
  });
  seleccionadas.addEventListener("dragover", function () {
    event.preventDefault();
  });
  seleccionadas.addEventListener("drop", function () {
    const id = event.dataTransfer.getData("id");
    seleccionadas.appendChild(document.getElementById(id));
    if (idSeleccionadas.indexOf(id) == -1) {
      idSeleccionadas.push(id);
    }
  });

  seleccionables.addEventListener("dragstart", function () {
    event.dataTransfer.setData("id", event.target.id);
  });
  seleccionadas.addEventListener("dragstart", function () {
    event.dataTransfer.setData("id", event.target.id);
  });

  function pidePreguntas() {
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        var preguntas = JSON.parse(ajax.responseText);
        if (preguntas.length > 0) {
          for (let i = 0; i < preguntas.length; i++) {
            var div = crearContenido(preguntas[i]);
            seleccionables.appendChild(div);
          }
        }
      }
    };
    ajax.open("GET", "../../php/entidades/pidePreguntas.php");
    ajax.send();
  }

  function crearContenido(pregunta) {
    const div1 = document.createElement("div");
    div1.setAttribute("id", "pregunta " + pregunta.id);
    div1.setAttribute("draggable", "true");
    div1.className = pregunta.tematica;
    const div2 = document.createElement("div");
    div2.className = pregunta.tematica;
    div2.innerHTML = "Tematica: " + pregunta.tematica;
    const div3 = document.createElement("div");
    div3.className = "enunciado";
    div3.innerHTML = "Enunciado: " + pregunta.enunciado;
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

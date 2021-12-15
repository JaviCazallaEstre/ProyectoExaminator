window.addEventListener("load", function () {
  finalizar = document.getElementById("finalizar");
  contenido = document.getElementById("contenido");

  idExamen = parametroGet("id");
  iPregunta = 1;
  pideExamen(idExamen);

  finalizar.onclick = function (ev) {
    ev.preventDefault();
    var preguntas = document.getElementsByName("pregunta");
    var arrayRespuestas=[];
    for (let i = 0; i < preguntas.length; i++) {
      let idPregunta = preguntas[i].attributes.value.value;
      var respuestas = document.getElementsByName("idPregunta"+idPregunta);
      var respuestaMarcada=null;
      for (let j = 0; j<respuestas.length; j++) {
        if (respuestas[j].checked) {
          respuestaMarcada = respuestas[j].value;
        }
      }
      debugger;
      var object = new Object();
      object.idPregunta = idPregunta;
      object.idRespuestaMarcada = respuestaMarcada;
      arrayRespuestas.push(object);
      
    }
    json=JSON.stringify(arrayRespuestas);
    let formu = new FormData();
    formu.append("finalizar","");
    formu.append("idExamen",idExamen);
    formu.append("respuestas",json);
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "creaExamenHecho.php");
    ajax.send(formu);
  };

  //peticion de datos
  //pedimos los id de las preguntas que pertenece al examen
  function pideExamen($idExamen) {
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        var idPreguntas = JSON.parse(ajax.responseText);
        for (let i = 0; i < idPreguntas.length; i++) {
          pidePregunta(idPreguntas[i]["pregunta_id"]);
        }
      }
    };
    ajax.open("GET", "sacaIdPreguntasExamen.php?idExamen=" + $idExamen);
    ajax.send();
  }
  //pedimos las preguntas del examen
  function pidePregunta(idPregunta) {
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        var pregunta = JSON.parse(ajax.responseText);
        contenido.appendChild(rellenaPagina(pregunta));
      }
    };
    ajax.open("GET", "sacaPreguntasExamen.php?idPregunta=" + idPregunta);
    ajax.send();
  }
  function parametroGet(nombre) {
    nombre = nombre.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + nombre + "=([^&#]*)"),
      results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }
  //rellenamos campos
  function rellenaPagina(pregunta) {
    const div1 = document.createElement("div");
    div1.setAttribute("id", "pregunta " + pregunta.id);
    div1.className = "pregunta";
    div1.setAttribute("value", pregunta.id);
    div1.setAttribute("name","pregunta");
    const div2 = document.createElement("div");
    div2.setAttribute("id", "enunciado");
    div2.innerHTML = iPregunta + "- " + pregunta.enunciado;
    iPregunta = iPregunta + 1;
    div1.appendChild(div2);
    if (pregunta.recurso != null) {
      const div3 = document.createElement("div");
      div3.setAttribute("id", "foto");
      imagen = new Image();
      imagen.src = "../../Recursos/Preguntas/" + pregunta.recurso;
      div3.appendChild(imagen);
      div1.appendChild(div3);
    }
    const div4 = document.createElement("div");
    div4.setAttribute("id", "opciones");
    //pedimos respuestas de las preguntas
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        var respuestas = JSON.parse(ajax.responseText);
        var div = escribeRespuestas(respuestas);
        div4.appendChild(div);
      }
    };
    ajax.open("GET", "sacaRespuestasExamen.php?idPregunta=" + pregunta.id);
    ajax.send();
    div1.appendChild(div4);
    return div1;
  }
  function escribeRespuestas(respuestas) {
    const form = document.createElement("form");
    for (let i = 0; i < respuestas.length; i++) {
      const radio = document.createElement("input");
      radio.setAttribute("type", "radio");
      radio.setAttribute("id", "respuesta_" + respuestas[i].id);
      radio.setAttribute("name", "idPregunta"+respuestas[i].pregunta_id);
      radio.setAttribute("value", respuestas[i].id);
      radio.className = "eleccion_" + respuestas[i].id;
      const label = document.createElement("label");
      label.innerHTML = respuestas[i].enunciado;
      const br = document.createElement("br");
      form.appendChild(radio);
      form.appendChild(label);
      form.appendChild(br);
    }
    return form;
  }
});

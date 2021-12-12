window.addEventListener("load", function () {
    cuerpoTabla = document.getElementById("tbody");
    pedirPreguntas();
    function pedirPreguntas() {
      const ajax = new XMLHttpRequest();
      ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
          var respuesta = JSON.parse(ajax.responseText);
          if (respuesta.length > 0) {
            for (let i = 0; i < respuesta.length; i++) {
              var tr = creaContenido(respuesta[i]);
              cuerpoTabla.appendChild(tr);
            }
          }
        }
      };
      ajax.open("GET", "sacaPreguntas.php");
      ajax.send();
    }
    function creaContenido(pregunta) {
      var id = pregunta.id;
      const tr = document.createElement("tr");
      tr.setAttribute("id", id);
      const td = document.createElement("td");
      td.innerHTML = pregunta.id;
      const td2 = document.createElement("td");
      td2.innerHTML = pregunta.enunciado;
      const td3= document.createElement("td");
      td3.innerHTML=pregunta.tematica; 
      tr.appendChild(td);
      tr.appendChild(td2);
      tr.appendChild(td3);
      return tr;
    }
  });
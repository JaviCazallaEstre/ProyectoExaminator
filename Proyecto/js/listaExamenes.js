window.addEventListener("load", function () {
  cuerpoTabla = document.getElementById("tbody");
  pedirTematicas();
  function pedirTematicas() {
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
    ajax.open("GET", "sacaExamenes.php");
    ajax.send();
  }
  function creaContenido(examen) {
    var id = examen.id;
    const tr = document.createElement("tr");
    tr.setAttribute("id", "examen "+id);
    const td = document.createElement("td");
    td.innerHTML = examen.id;
    const td2 = document.createElement("td");
    td2.innerHTML = examen.descripcion;
    const td3 = document.createElement("td");
    td3.innerHTML = examen.duracion;
    const td4 = document.createElement("td");
    if (examen.activo == 1) {
      td4.innerHTML = "Activo";
    } else {
      td4.innerHTML = "Inactivo";
    }
    const td5 = document.createElement("td");
    td5.innerHTML =
      "<a href='../formularios/creaExamenHecho.php?id=" + id + "'>Realizar</a>";
    tr.appendChild(td);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    return tr;
  }
});

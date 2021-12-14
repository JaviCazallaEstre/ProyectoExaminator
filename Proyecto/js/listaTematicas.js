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
    ajax.open("GET", "sacaTematicas.php");
    ajax.send();
  }
  function creaContenido(tematica) {
    var id = tematica.id;
    const tr = document.createElement("tr");
    tr.setAttribute("id", "tematica" + id);
    const td = document.createElement("td");
    td.innerHTML = tematica.id;
    const td2 = document.createElement("td");
    td2.innerHTML = tematica.descripcion;
    tr.appendChild(td);
    tr.appendChild(td2);
    return tr;
  }
});

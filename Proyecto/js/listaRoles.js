window.addEventListener("load", function () {
  cuerpoTabla = document.getElementById("tbody");
  pedirRoles();
  function pedirRoles() {
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
    ajax.open("GET", "sacaRoles.php");
    ajax.send();
  }
  function creaContenido(rol) {
    var id = rol.id;
    const tr = document.createElement("tr");
    tr.setAttribute("id", "rol " + id);
    const td = document.createElement("td");
    td.innerHTML = rol.id;
    const td2 = document.createElement("td");
    td2.innerHTML = rol.descripcion;
    tr.appendChild(td);
    tr.appendChild(td2);
    return tr;
  }
});

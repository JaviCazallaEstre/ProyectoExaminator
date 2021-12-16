window.addEventListener("load", function () {
  cuerpoTabla = document.getElementById("tbody");
  buscador=document.getElementById("Buscador");
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
  buscador.addEventListener("keyup",function (ev) {
    //Este bloque de codigo, lo conseguí buscando sobre la manera de llamar a un bucle
    //for each llamando a una coleccion como recoge getElementsByTagName() aunque entiendo su funcionamiento
    Array.prototype.forEach.call( document.getElementsByTagName("tr"), (filaActual, nFila) => {
      //Para saber si mostrar o no una fila, se me ocurre imitar lo que en lenguajes como C se conocen como Flag
      //y usar una variable que solo podrá entrar una vez por fila y si no entra se ocultará,
      //si encuentra es porque hay coincidencia de busqueda
      oculto = "espera"
      //Por cada fila llamamos a sus celdas y comprobamos los resultados
      Array.prototype.forEach.call( document.getElementsByTagName("tr")[nFila].children, 
          (celdaActual) => {
            if(nFila > 0){
              celdaActual.innerText.toLowerCase().
              includes(ev.target.value.toLowerCase());
              if ( celdaActual.innerText.toLowerCase().
                  includes(ev.target.value.toLowerCase()) &&
                  oculto === "espera") {
                  oculto = "no";
                  
                  }
              }
            });
            
        if (oculto === "espera" && nFila > 0 && document.getElementsByTagName("tr")[nFila].parentElement.tagName!=="TFOOT") {
          filaActual.style.setProperty("display","none");
        }else{
          filaActual.style.setProperty("display","table-row");
        }
      })
    });
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

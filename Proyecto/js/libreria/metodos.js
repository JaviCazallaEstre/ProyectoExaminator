function escribeErrores(atributo, errores, elemento) {
  parrafo = document.createElement("p");
  parrafo.innerHTML = errores[atributo];
  parrafo.setAttribute("class", "error");
  elemento.appendChild(parrafo);
}
function enviarFormularioAjax(texto, ruta) {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", ruta);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajax.send(texto);
}

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
function calcularEdad(fecha_nacimiento) {
  var hoy = new Date();
  var cumpleanos = new Date(fecha_nacimiento);
  var edad = hoy.getFullYear() - cumpleanos.getFullYear();
  var m = hoy.getMonth() - cumpleanos.getMonth();
  if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
      edad--;
  }
  return edad;
}
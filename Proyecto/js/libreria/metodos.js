function escribeErrores(atributo, errores, elemento) {
    parrafo = document.createElement("p");
    parrafo.innerHTML = errores[atributo];
    parrafo.setAttribute("class", "error");
    elemento.appendChild(parrafo);
  }
window.addEventListener("load", function () {
  const formulario = document.getElementById("formu");
  const enviar = document.getElementById("enviar");
  var tematica = document.getElementById("tematica");
  var enunciado = document.getElementById("enunciado");
  var opcion1 = document.getElementById("opcion1");
  var opcion2 = document.getElementById("opcion2");
  var opcion3 = document.getElementById("opcion3");
  var opcion4 = document.getElementById("opcion4");
  var archivo = document.getElementById("archivo");
  var correcta = document.getElementsByName("correcta");

  enviar.onclick = function (ev) {
    ev.preventDefault();
    var tematicaElegida = tematica.options[tematica.selectedIndex].text;
    errores = validaPregunta(
      tematicaElegida,
      enunciado.value,
      opcion1.value,
      opcion2.value,
      opcion3.value,
      opcion4.value,
      correcta
    );
    if (Object.keys(errores).length > 0) {
      muestraErrores(errores);
    } else {
      var opcionCorrecta = "";
      for (i = 0; i < correcta.length; i++) {
        if (correcta[i].checked) {
          opcionCorrecta = correcta[i].value;
        }
      }
      var texto = encodeURI(
        "enviar=&tematica=" +
          tematica.value +
          "&enunciado=" +
          enunciado.value +
          "&archivo=" +
          archivo.src +
          "&opcion1=" +
          opcion1.value +
          "&opcion2=" +
          opcion2.value +
          "&opcion3=" +
          opcion3.value +
          "&opcion4=" +
          opcion4.value +
          "&correcta" +
          opcionCorrecta
      );
    }
  };
  function muestraErrores(errores) {
    const tdTematica = document.getElementById("tdTematica");
    const tdEnunciado = document.getElementById("tdEnunciado");
    const tdOpcion1 = document.getElementById("tdOpcion1");
    const tdOpcion2 = document.getElementById("tdOpcion2");
    const tdOpcion3 = document.getElementById("tdOpcion3");
    const tdOpcion4 = document.getElementById("tdOpcion4");
    const tdRadio = document.getElementById("tdRadio");
    if (errores.hasOwnProperty("tematica")) {
      escribeErrores("tematica", errores, tdTematica);
    }
    if (errores.hasOwnProperty("enunciado")) {
      escribeErrores("enunciado", errores, tdEnunciado);
    }
    if (errores.hasOwnProperty("opcion1")) {
      escribeErrores("opcion1", errores, tdOpcion1);
    }
    if (errores.hasOwnProperty("opcion2")) {
      escribeErrores("opcion2", errores, tdOpcion2);
    }
    if (errores.hasOwnProperty("opcion3")) {
      escribeErrores("opcion3", errores, tdOpcion3);
    }
    if (errores.hasOwnProperty("opcion4")) {
      escribeErrores("opcion4", errores, tdOpcion4);
    }
    if (errores.hasOwnProperty("correcta")) {
      escribeErrores("correcta", errores, tdRadio);
    }
  }
  function validaPregunta(
    tematica,
    enunciado,
    opcion1,
    opcion2,
    opcion3,
    opcion4,
    correcta
  ) {
    errores = [];
    if (tematica == "") {
      errores["tematica"] = "Debe de haber una temática seleccionada";
    }
    if (enunciado == "") {
      errores["enunciado"] = "El campo enunciado debe de estar relleno";
    }
    if (opcion1 == "") {
      errores["opcion1"] = "La primera opción debe de estar rellena";
    }
    if (opcion2 == "") {
      errores["opcion2"] = "La segunda opción debe de estar rellena";
    }
    if (opcion3 == "") {
      errores["opcion3"] = "La tercera opción debe de estar rellena";
    }
    if (opcion4 == "") {
      errores["opcion4"] = "La cuarta opción debe de estar rellena";
    }
    var opcionCorrecta = "";
    for (i = 0; i < correcta.length; i++) {
      if (correcta[i].checked) {
        opcionCorrecta = correcta[i].value;
      }
    }
    if (opcionCorrecta == "") {
      errores["correcta"] = "Debes de elegir una opción como la correcta";
    }
    return errores;
  }
});

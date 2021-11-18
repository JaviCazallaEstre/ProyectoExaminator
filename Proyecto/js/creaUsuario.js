window.addEventListener("load", function () {
  const formulario = document.getElementById("formu");
  const enviar = document.getElementById("crear");
  var email = document.getElementById("email");
  var nombre = document.getElementById("nombre");
  var apellidos = document.getElementById("apellidos");
  var contrasena = document.getElementById("contrasena");
  var contrasenaIgual = document.getElementById("contrasenaIgual");
  var fecha = document.getElementById("fecha");
  var foto = document.getElementById("foto");

  enviar.onclick = function (ev) {
    ev.preventDefault();
    errores = validaUsuario(
      email.value,
      nombre.value,
      apellidos.value,
      contrasena.value,
      contrasenaIgual.value,
      fecha.value,
      foto.src
    );
    if (Object.keys(errores).length > 0) {
      muestraErrores(errores);
    } else {
      var texto = encodeURI(
        "crear=&email=" +
          email.value +
          "&nombre=" +
          nombre.value +
          "&apellidos=" +
          apellidos.value +
          "&contrasena=" +
          contrasena.value +
          "&fecha=" +
          fecha.value +
          "&foto=" +
          foto.src
      );
      const ajax = new XMLHttpRequest();
      ajax.open("POST", "../php/formularios/creaUsuario.php");
      ajax.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      ajax.send(texto);
    }
  };

  function muestraErrores(errores) {
    const tdEmail = document.getElementById("tdEmail");
    const tdNombre = document.getElementById("tdNombre");
    const tdApellidos = document.getElementById("tdApellidos");
    const tdContrasena = document.getElementById("tdContrasena");
    const tdContrasenaIgual = document.getElementById("tdContrasenaIgual");
    const tdFecha = document.getElementById("tdFecha");
    const tdfoto = document.getElementById("tdfoto");
    if (errores.hasOwnProperty("email")) {
      escribeErrores("email", errores, tdEmail);
    }
    if (errores.hasOwnProperty("nombre")) {
      escribeErrores("nombre", errores, tdNombre);
    }
    if (errores.hasOwnProperty("apellidos")) {
      escribeErrores("apellidos", errores, tdApellidos);
    }
    if (errores.hasOwnProperty("contrasena")) {
      escribeErrores("contrasena", errores, tdContrasena);
    }
    if (errores.hasOwnProperty("contrasenaIgual")) {
      escribeErrores("contrasenaIgual", errores, tdContrasenaIgual);
    }
    if (errores.hasOwnProperty("fecha")) {
      escribeErrores("fecha", errores, tdFecha);
    }
    if (errores.hasOwnProperty("foto")) {
      escribeErrores("foto", errores, tdfoto);
    }
  }

  function escribeErrores(atributo, errores, elemento) {
    parrafo = document.createElement("p");
    parrafo.innerHTML = errores[atributo];
    parrafo.setAttribute("class", "error");
    elemento.appendChild(parrafo);
  }

  function validaUsuario(
    email,
    nombre,
    contrasena,
    contrasenaIgual,
    fecha,
    foto
  ) {
    errores = [];
    if (email == "") {
      errores["email"] = "El campo email debe de estar relleno";
    } else if (!email.esEmail()) {
      errores["email"] = "El campo email no es válido";
    }
    var expresionNombreApellido = /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/;
    if (nombre == "") {
      errores["nombre"] = "El campo nombre debe de estar relleno";
    } else if (expresionNombreApellido.test(nombre) == false) {
      errores["nombre"] = "El formato de nombre no es válido";
    }
    if (apellidos == "") {
      errores["apellidos"] = "El campo apellidos debe de estar relleno";
    } else if (expresionNombreApellido.test(apellidos) == false) {
      errores["apellidos"] =
        "El formato del campo apellidos debe de estar relleno";
    }
    if (contrasena == "") {
      errores["contrasena"] = "El campo contraseña debe de estar relleno";
    } else if (contrasenaIgual == "") {
      errores["contrasenaIgual"] =
        "El campo confirmar contraseña debe de estar relleno";
    } else if (contrasena != contrasenaIgual) {
      errores[contrasenaIgual] = "Las contraseñas no coinciden";
    }
    if (fecha == "") {
      errores["fecha"] = "El campo fecha debe de estar relleno";
    } else if (fecha.esFecha()) {
      errores["fecha"] = "Debe introducir una fecha valida";
    }
    if (foto != "") {
      if (!/^image\//.test(foto.files[0].type)) {
        errores["foto"] = "El archivo debe de ser una foto";
      }
    }
    return errores;
  }
});

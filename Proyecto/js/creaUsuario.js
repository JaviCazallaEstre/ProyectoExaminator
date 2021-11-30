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
      foto
    );
    if (Object.keys(errores).length > 0) {
      muestraErrores(errores);
    } else {
      formu = new FormData();
      formu.append("crear", "");
      formu.append("email", email.value);
      formu.append("nombre", nombre.value);
      formu.append("apellidos", apellidos.value);
      formu.append("contrasena", contrasena.value);
      formu.append("fecha", fecha.value);
      if (/^image\//.test(foto.files[0].type)) {
        formu.append("foto", foto.files[0]);
      }
      const ajax = new XMLHttpRequest();
      ajax.open("POST", "creaUsuario.php");
      ajax.send(formu);
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
    } else if (!fecha.esFecha()) {
      errores["fecha"] = "Debe introducir una fecha valida";
    } else if (calcularEdad(fecha) < 18) {
      errores["fecha"] = "La edad debe de ser mayor de 18 años";
    }
    if (foto.files[0] != "") {
      limiteKB = 200;
      if (!/^image\//.test(foto.files[0].type)) {
        errores["foto"] = "El archivo debe de ser una foto";
      } else if (foto.files[0].size > limiteKB * 1024) {
        errores["foto"] = "El tamaño de la foto no puede superar los 200KB";
      }
    }
    return errores;
  }
});

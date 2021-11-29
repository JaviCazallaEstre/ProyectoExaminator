window.addEventListener("load", function () {
    const formu = document.getElementById("formu");
    const crear = document.getElementById("crear");
    var nombre = document.getElementById("nombre");
  
    crear.onclick = function (ev) {
      ev.preventDefault();
      errores = validaRol(nombre.value);
      if (Object.keys(errores).length > 0) {
        muestraErrores(errores);
      } else {
        formulario= new FormData();
        formulario.append("crear","");
        formulario.append("nombre",nombre.value);
        const ajax = new XMLHttpRequest();
        ajax.open("POST","creaRol.php");
        ajax.send(formulario);
      }
    };
  
    function validaRol(nombre) {
      errores = [];
      if (nombre == "") {
        errores["nombre"] = "El campo nombre debe de estar relleno";
      }
      return errores;
    }
    function muestraErrores(errores) {
      const tdNombre = document.getElementById("tdNombre");
      if (errores.hasOwnProperty("nombre")) {
        escribeErrores("nombre", errores, tdNombre);
      }
    }
  });
  
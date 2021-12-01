window,
  addEventListener("load", function () {
    const formu = document.getElementById("formu");
    const enviar = document.getElementById("enviar");
    var email = document.getElementById("email");

    enviar.onclick(function (ev) {
      ev.preventDefault();
      errores = validaAlta(email.value, fecha.value);
      if(Object.keys(errores).length>0){
          muestraErrores(errores);
      }else{
          formulario= new FormData();
          formulario.append("enviar","");
          formulario.append("email",email.value);
          const ajax = new XMLHttpRequest();
          ajax.open("POST","altaUsuario.php");
          ajax.send(formulario);
      }
    });

    function validaAlta(email, fecha) {
      errores = [];
      if (email == "") {
        errores["email"] = "El campo email debe de estar relleno";
      } else if (!email.esEmail()) {
        errores["email"] = "El campo email no es válido";
      }
      return errores;
    }
    function muestraErrores(errores) {
      const tdEmail = document.getElementById("tdEmail");
      if (errores.hasOwnProperty("email")) {
        escribeErrores("email", errores, tdEmail);
      }
    }
  });

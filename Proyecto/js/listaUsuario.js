window.addEventListener("load", function () {
    cuerpoTabla = document.getElementById("tbody");
    pedirUsuarios();
    function pedirUsuarios() {
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
      ajax.open("GET", "sacaUsuarios.php");
      ajax.send();
    }
    function creaContenido(usuario) {
      var id = usuario.id;
      const tr = document.createElement("tr");
      tr.setAttribute("id", "usuario "+id);
      const td = document.createElement("td");
      td.innerHTML = usuario.id;
      const td2 = document.createElement("td");
      td2.innerHTML = usuario.nombre;
      const td3= document.createElement("td");
      td3.innerHTML=usuario.apellidos;
      const td4 =document.createElement("td");
      if(usuario.rol_id==1){
          $rol="Profesor";
      }else{
          $rol="Alumno";
      }
      td4.innerHTML=$rol;
      const td5=document.createElement("td");
      td5.innerHTML="<a href='../formularios/creaUsuario.php?modo=modifica&id="+id+"'>Modificar</a>"
      const td6=document.createElement("td");
      td6.innerHTML=usuario.email;
      tr.appendChild(td);
      tr.appendChild(td6);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
      tr.appendChild(td5);
      return tr;
    }
  });
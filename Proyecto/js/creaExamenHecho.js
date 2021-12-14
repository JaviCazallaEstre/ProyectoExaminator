window.addEventListener("load", function () {
  finalizar = document.getElementById("finalizar");
  finalizar.onclick = function (ev) {
    ev.preventDefault();
    let formu= new FormData();
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "creaExamenHecho.php");
    ajax.send(formu);
  };
});

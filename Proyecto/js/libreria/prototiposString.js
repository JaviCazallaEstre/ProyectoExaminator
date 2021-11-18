//Método para validar dni
//que dada una cadena devuelve booleano
String.prototype.esDNI=function(){
    var respuesta=false;
    var partes= (/^(\d{8})([A-Z])$/).exec(this.toUpperCase())
    if (partes && partes.length==3){
       respuesta=("TRWAGMYFPDXBNJZSQVHLCKE"[partes[1]%23]==partes[2])
    }
    return respuesta;
};

String.prototype.esFecha=function(){
    var respuesta=false;
    var partes=(/^(\d\d)\/(\d\d)\/(\d{4})$/).exec(this.valueOf());
    if (partes && partes.length==4){
        var dia=new Date(partes[3],partes[2]-1,partes[1]);
        if (dia.getDate()==partes[1] &&
            dia.getMonth()==partes[2]-1 &&
            dia.getFullYear()==partes[3]){
                respuesta=true;
            }
     }
     return respuesta;
};
String.prototype.esEmail=function () {
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (emailRegex.test(this)) {
      return true;
    } else {
      return false;
    }
};
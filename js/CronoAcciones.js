// document.addEventListener('DOMContentLoaded', reloj());
function reloj(){
    if (horaActual < 12 && document.getElementById("saludo")) {
        saludo.innerText = '¡Buenos días ';
    }else if(horaActual > 12 && horaActual < 18 && document.getElementById("saludo")){
        saludo.innerText = '¡Buenas tardes ';
    }else if(horaActual > 18 && document.getElementById("saludo")){
        saludo.innerText = '¡Buenas noches ';
    }
}
setInterval('reloj()', 5000);
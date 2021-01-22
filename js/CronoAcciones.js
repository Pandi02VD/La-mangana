// document.addEventListener('DOMContentLoaded', reloj());
function reloj(){
    if (horaActual < 12) {
        saludo.innerText = 'Buenos días';
    }else if(horaActual > 12 && horaActual < 18){
        saludo.innerText = 'Buenas tardes';
    }else if(horaActual > 18){
        saludo.innerText = 'Buenas noches';
    }
}
setInterval('reloj()', 5000);
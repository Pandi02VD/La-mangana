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
setInterval('reloj()', 5000); //--------------------- ****************** -> =>  

function usuarioEstado(){
    // $(document).ready(() => {
        // var usuariosExistentes = new Array();
        
        // for (let i = 0; i < CHECK_USER.length; i++) {
        //     usuariosExistentes.push(CHECK_USER[i]);
        // }
        
        // var dataUsuariosExistentes = JSON.stringify(usuariosExistentes);
        
        // var estadoUsuarios = new FormData();
        // estadoUsuarios.append("estado-usuarios", dataUsuariosExistentes);
        var dataUsuariosExistentes = "Hola";

        var estadoUsuarios = new FormData();
        estadoUsuarios.append("estado-usuarios", dataUsuariosExistentes);
        
        $.ajax({
            url: "controlador/Ajax.php", 
            method: "post", 
            data: estadoUsuarios, 
            cache: false, 
            contentType: false, 
            processData: false, 
            dataType: "json", 
            success: function(respuesta){
                if (respuesta) {
                    $.each(respuesta, function(k, v) {
                        for (let i = 0; i < USER_STATUS.length; i++) {
                            if(USER_STATUS[i].getAttribute('id') == v.iduser){
                                if (v.status == 1) {
                                    USER_STATUS[i].innerText = "En línea";
                                }else if(v.status == 0) {
                                    USER_STATUS[i].innerText = "Desconectado";
                                }
                            }
                        }
                    });
                }else{
                }
            }
        });
    // });
}


// if (USER_STATUS) {
    setInterval('usuarioEstado()', 1000);
    // setTimeout('usuarioEstado()', 1000);
// }
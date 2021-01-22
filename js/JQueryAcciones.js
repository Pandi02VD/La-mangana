$(BTN_EDIT_USER).click(function(){
    if (CHECK_USER) {
        var usuarioElegido;
        for (let i = 0; i < CHECK_USER.length; i++) {
            if (CHECK_USER[i].checked) {
                usuarioElegido = CHECK_USER[i].value;
            }
        }

        var datos = new FormData();
        datos.append("usuarioId", usuarioElegido);
        
        $.ajax({
            url: "controlador/Ajax.php", 
            method: "post", 
            data: datos, 
            cache: false, 
            contentType: false, 
            processData: false, 
            dataType: "json", 
            success: function(respuesta){
                if (respuesta) {
                    $('#tipo-usuario').val(respuesta["tipo"]);
                    $('#nombre').val(respuesta["nombre"]);
                    $('#usuarioId').val(usuarioElegido);
                }
            }
        });
    }
});

$(BTN_EDIT_CLIENT).click(function(){
    if (CHECK_CLIENT) {
        var clienteElegido;
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            if (CHECK_CLIENT[i].checked) {
                clienteElegido = CHECK_CLIENT[i].value;
            }
        }

        var datos = new FormData();
        datos.append("clienteId", clienteElegido);
        
        $.ajax({
            url: "controlador/Ajax.php", 
            method: "post", 
            data: datos, 
            cache: false, 
            contentType: false, 
            processData: false, 
            dataType: "json", 
            success: function(respuesta){
                if (respuesta) {
                    $('#cliente').val(respuesta["cliente"]);
                    $('#clienteId').val(clienteElegido);
                }
            }
        });
    }
});
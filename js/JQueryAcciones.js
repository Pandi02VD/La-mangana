$(document).ready(function(){
    $('.tabs a:first').addClass('active');
    $('#tabs-content .ficha__info').hide();
    $('#tabs-content .ficha__info:first').show();
    
    $('.tabs a').click(function(){
        $('.tabs a').removeClass('active');
        $(this).addClass('active');
        $('#tabs-content .ficha__info').hide();

        let tabActiva = $(this).attr('href');
        $(tabActiva).show();
        return false;
    });
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
                    $('#cliente-edit').val(respuesta["cliente"]);
                    $('#clienteId-edit').val(clienteElegido);
                }
            }
        });
    }
});

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
                    $('#tipo-usuario-edit').val(respuesta["tipo"]);
                    $('#nombre-edit').val(respuesta["nombre"]);
                    $('#usuarioId-edit').val(usuarioElegido);
                }
            }
        });
    }
});

// $(BTN_EDIT_PET).click(function(){
//     if (CHECK_PET) {
//         var mascotaElegida;
//         for (let i = 0; i < CHECK_PET.length; i++) {
//             if (CHECK_PET[i].checked) {
//                 mascotaElegida = CHECK_PET[i].value;
//             }
//         }

//         var datos = new FormData();
//         datos.append("mascotaId", mascotaElegida);
        
//         $.ajax({
//             url: "controlador/Ajax.php", 
//             method: "post", 
//             data: datos, 
//             cache: false, 
//             contentType: false, 
//             processData: false, 
//             dataType: "json", 
//             success: function(respuesta){
//                 if (respuesta) {
//                     $('#mascota-edit').val(respuesta["mascota"]);
//                     $('#mascotaId-edit').val(mascotaElegida);
//                 }
//             }
//         });
//     }
// });

$(BTN_C_DELETE_CLIENT).click(function(){
    if (CHECK_CLIENT) {
        $('#form-delete-client').css('background-color', 'rgba(0, 0, 0, 0.6)');
        $(this).css('cursor', 'progress', '!IMPORTANT');
        $(this).attr('value', 'Procesando...');
        $('body').css('cursor', 'progress', '!IMPORTANT');
        var clientesElegidosEliminar = new Array();
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            if (CHECK_CLIENT[i].checked) {
                clientesElegidosEliminar.push(CHECK_CLIENT[i].value);
            }
        }

        var data = JSON.stringify(clientesElegidosEliminar);

        var datos = new FormData();
        // for (let i = 0; i < CHECK_CLIENT.length; i++) {
            datos.append("clientesEliminarId", data);
        // }
        
        $.ajax({
            url: "controlador/Ajax.php", 
            method: "post", 
            data: datos, 
            cache: false, 
            contentType: false, 
            processData: false, 
            // dataType: "json", 
            success: function(respuesta){
                if (respuesta) {
                    console.log(respuesta);
                    window.location = "index.php?pagina=Clientes";
                    alert("¡Se han eliminado los registros!");
                }else{
                }
            }
        });
    }
});

$(BTN_C_DELETE_USER).click(function(){
    if (CHECK_USER) {
        $('#form-delete-user').css('background-color', 'rgba(0, 0, 0, 0.6)');
        $(this).css('cursor', 'progress', '!IMPORTANT');
        $(this).attr('value', 'Procesando...');
        $('body').css('cursor', 'progress', '!IMPORTANT');
        // var usuariosElegidosEliminar = new Array();
        // for (let i = 0; i < CHECK_USER.length; i++) {
        //     if (CHECK_USER[i].checked) {
        //         usuariosElegidosEliminar.push(CHECK_USER[i].value);
        //     }
        // }

        // var data = JSON.stringify(usuariosElegidosEliminar);

        // var datos = new FormData();
        // // for (let i = 0; i < CHECK_CLIENT.length; i++) {
        //     datos.append("clientesEliminarId", data);
        // // }
        
        // $.ajax({
        //     url: "controlador/Ajax.php", 
        //     method: "post", 
        //     data: datos, 
        //     cache: false, 
        //     contentType: false, 
        //     processData: false, 
        //     // dataType: "json", 
        //     success: function(respuesta){
        //         if (respuesta) {
        //             console.log(respuesta);
        //             window.location = "index.php?pagina=Clientes";
        //             alert("¡Se han eliminado los registros!");
        //         }else{
        //         }
        //     }
        // });
    }
});
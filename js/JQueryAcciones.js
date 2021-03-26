function tabsModal(){
    $('.tabs a:first').addClass('active');
    $('[name="tabs-content"] .ficha__info').hide();
    $('[name="tabs-content"] .ficha__info:first').show();
    
    $('.tabs a').click(function(){
        $('.tabs a').removeClass('active');
        $(this).addClass('active');
        $('[name="tabs-content"] .ficha__info').hide();

        let tabActiva = $(this).attr('href');
        $(tabActiva).show();
        return false;
    });
}

function multiFormModal(){    
    $('#btn-first').click(function(){
        $('#form-add-Consult-pet').addClass('oculto');
        $('#form-add-H-pet').removeClass('oculto');
    });
    
    $('#btn-return-to-first').click(function(){
        $('#form-add-Consult-pet').removeClass('oculto');
        $('#form-add-H-pet').addClass('oculto');
    });
}

$(document).ready(function(){
    tabsModal();
    multiFormModal();
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
        var usuariosElegidosEliminar = new Array();
        for (let i = 0; i < CHECK_USER.length; i++) {
            if (CHECK_USER[i].checked) {
                usuariosElegidosEliminar.push(CHECK_USER[i].value);
            }
        }

        var dataUsuarios = JSON.stringify(usuariosElegidosEliminar);

        var datosUsuarios = new FormData();
        // for (let i = 0; i < CHECK_CLIENT.length; i++) {
            datosUsuarios.append("usuariosEliminarId", dataUsuarios);
        // }
        
        $.ajax({
            url: "controlador/Ajax.php", 
            method: "post", 
            data: datosUsuarios, 
            cache: false, 
            contentType: false, 
            processData: false, 
            // dataType: "json", 
            success: function(respuesta){
                if (respuesta) {
                    console.log(respuesta);
                    window.location = "index.php?pagina=Usuarios";
                    alert("¡Se han eliminado los registros!");
                }else{
                }
            }
        });
    }
});

function seleccionarClienteTelefonos(clientsCheck){
    var requestClientePhones = clientsCheck;

    var datos = new FormData();
    datos.append("requestClientePhones", requestClientePhones);
    
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
                console.log(respuesta);
                    for (const telefonos of respuesta) {
                        $('#tbl-client-phones tbody').append(
                            '<tr>' + 
                                '<td name="client-phone-number">' + telefonos['numero'] + '</td>' + 
                                '<td name="client-phone-type">' + telefonos['tipo'] + '</td>' + 
                                '<td>' + 
                                    '<div class="C__Btn">' + 
                                        '<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-phone">' + 
                                        '<span class="tooltip">Editar</span>' + 
                                    '</div>' + 
                                    '<div class="C__Btn">' + 
                                        '<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-phone">' + 
                                        '<span class="tooltip">Eliminar</span>' + 
                                    '</div>' + 
                                '</td>' + 
                            '</tr>'
                        );
                    }
                }else{
                    $('#tab-client-phone tbody').append(
                        '<tr>' + 
                            '<td name="client-phone-number">Sin datos</td>' + 
                            '<td name="client-phone-type">Sin datos</td>' + 
                            '<td>Sin datos</td>' + 
                        '</tr>'
                    );
                }
        }
    });
}

$(BTN_CARD_CLIENT).click(function(){
    if (CHECK_CLIENT) {
        var requestClienteEmails;
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            if (CHECK_CLIENT[i].checked) {
                requestClienteEmails = CHECK_CLIENT[i].value;
            }
        }

        var datos = new FormData();
        datos.append("requestClienteEmails", requestClienteEmails);
        
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
                    console.log(respuesta);
                    for (const correos of respuesta) {
                        $('#tbl-client-emails tbody').append(
                            '<tr>' + 
                                '<td name="client-email-address">' + correos['correo'] + '</td>' + 
                                '<td>' + 
                                    '<div class="C__Btn">' + 
                                        '<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-email">' + 
                                        '<span class="tooltip">Editar</span>' + 
                                    '</div>' + 
                                    '<div class="C__Btn">' + 
                                        '<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-email">' + 
                                        '<span class="tooltip">Eliminar</span>' + 
                                    '</div>' + 
                                '</td>' + 
                            '</tr>'
                        );
                    }

                }else{
                    $('#tab-client-email tbody').append(
                        '<tr>' + 
                            '<td name="client-email-address">Sin datos</td>' + 
                            '<td>Sin datos</td>' + 
                        '</tr>'
                    );
                }

                seleccionarClienteTelefonos(requestClienteEmails);
            }
        });
    }
});

$(BTN_ADD_CLIENT_EMAIL).click(function(){
    if (CHECK_CLIENT) {
        var clienteElegido;
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            if (CHECK_CLIENT[i].checked) {
                clienteElegido = CHECK_CLIENT[i].value;
            }
        }

        $('#cliente-add-email-id').val(clienteElegido);
    }
});

$(BTN_ADD_CLIENT_PHONE).click(function(){
    if (CHECK_CLIENT) {
        var clienteElegido;
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            if (CHECK_CLIENT[i].checked) {
                clienteElegido = CHECK_CLIENT[i].value;
            }
        }

        $('#cliente-add-phone-id').val(clienteElegido);
    }
});
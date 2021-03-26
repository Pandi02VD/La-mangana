if (USERS_TABLE) {
    for (let i = 0; i < USERS_TABLE.length; i++) {
        USERS_TABLE[i].addEventListener('click', () => {
            let idUserTable = USERS_TABLE[i].getAttribute('id');
            window.location = "index.php?pagina=Usuario&uu=" + idUserTable;
        });
    }
}

if (CLIENTS_TABLE) {
    for (let i = 0; i < CLIENTS_TABLE.length; i++) {
        CLIENTS_TABLE[i].addEventListener('click', () => {
            let idClientTable = CLIENTS_TABLE[i].getAttribute('id');
            window.location = "index.php?pagina=Cliente&uc=" + idClientTable;
        });
    }
}

if (PETS_TABLE) {
    for (let i = 0; i < PETS_TABLE.length; i++) {
        PETS_TABLE[i].addEventListener('click', () => {
            window.location = "index.php?pagina=Mascota";
        });
    }
}



if (CHECK_ALL_CLIENTS) {
    CHECK_ALL_CLIENTS.addEventListener('click', () => {
    if (CHECK_ALL_CLIENTS.checked) {
        numCheckedClients = CHECK_CLIENT.length;
        checkClientes(numCheckedClients);
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            CHECK_CLIENT[i].checked = true;
            BTN_DELETE_CLIENT.disabled = false;
        }
    }else{
        numCheckedClients = 0;
        checkClientes(numCheckedClients);
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            CHECK_CLIENT[i].checked = false;
            BTN_DELETE_CLIENT.disabled = true;
        }
    }
});
    for(let i = 0; i < CHECK_CLIENT.length; i++){
    CHECK_CLIENT[i].addEventListener('click', () => {
        if (CHECK_CLIENT[i].checked) {
            ++numCheckedClients;
            checkClientes(numCheckedClients);
        }else{
            --numCheckedClients;
            checkClientes(numCheckedClients);
        }
        if (numCheckedClients == CHECK_CLIENT.length) {
            CHECK_ALL_CLIENTS.checked = true;
        }else{
            CHECK_ALL_CLIENTS.checked = false;
        }
    });
}
}

if (CHECK_ALL_USERS) {
    CHECK_ALL_USERS.addEventListener('click', () => {
        if (CHECK_ALL_USERS.checked) {
            numCheckedUsers = CHECK_USER.length;
            checkUsuarios(numCheckedUsers);
            for (let i = 0; i < CHECK_USER.length; i++) {
                CHECK_USER[i].checked = true;
                BTN_DELETE_USER.disabled = false;
            }
        }else{
            numCheckedUsers = 0;
            checkUsuarios(numCheckedUsers);
            for (let i = 0; i < CHECK_USER.length; i++) {
                CHECK_USER[i].checked = false;
                BTN_DELETE_USER.disabled = true;
            }
        }
    });
    
    for(let i = 0; i < CHECK_USER.length; i++){
        CHECK_USER[i].addEventListener('click', () => {
            if (CHECK_USER[i].checked) {
                ++numCheckedUsers;
                checkUsuarios(numCheckedUsers);
            }else{
                --numCheckedUsers;
                checkUsuarios(numCheckedUsers);
            }
            if (numCheckedUsers == CHECK_USER.length) {
                CHECK_ALL_USERS.checked = true;
            }else{
                CHECK_ALL_USERS.checked = false;
            }
        });
    }
}

if (CHECK_ALL_PETS) {
    CHECK_ALL_PETS.addEventListener('click', () => {
        if (CHECK_ALL_PETS.checked) {
            numCheckedPets = CHECK_PET.length;
            checkMascotas(numCheckedPets);
            for (let i = 0; i < CHECK_PET.length; i++) {
                CHECK_PET[i].checked = true;
                BTN_DELETE_PET.disabled = false;
            }
        }else{
            numCheckedPets = 0;
            checkMascotas(numCheckedPets);
            for (let i = 0; i < CHECK_PET.length; i++) {
                CHECK_PET[i].checked = false;
                BTN_DELETE_PET.disabled = true;
            }
        }
    });
    
    for(let i = 0; i < CHECK_PET.length; i++){
        CHECK_PET[i].addEventListener('click', () => {
            if (CHECK_PET[i].checked) {
                ++numCheckedPets;
                checkMascotas(numCheckedPets);
            }else{
                --numCheckedPets;
                checkMascotas(numCheckedPets);
            }
            if (numCheckedPets == CHECK_PET.length) {
                CHECK_ALL_PETS.checked = true;
            }else{
                CHECK_ALL_PETS.checked = false;
            }
        });
    }
}

function checkUsuarios(numCheckedUsuarios){
    if(numCheckedUsuarios > 1){
        BTN_EDIT_USER.disabled = true;
        BTN_DELETE_USER.disabled = false;
    }else if(numCheckedUsuarios == 1){
        BTN_EDIT_USER.disabled = false;
        BTN_DELETE_USER.disabled = false;
    }else if(numCheckedUsuarios == 0){
        BTN_EDIT_USER.disabled = true;
        BTN_DELETE_USER.disabled = true;
    }
}

function checkClientes(numCheckedClientes){
    if(numCheckedClientes > 1){
        BTN_EDIT_CLIENT.disabled = true;
        BTN_CARD_CLIENT.disabled = true;
        BTN_DELETE_CLIENT.disabled = false;
    }else if(numCheckedClientes == 1){
        BTN_EDIT_CLIENT.disabled = false;
        BTN_CARD_CLIENT.disabled = false;
        BTN_DELETE_CLIENT.disabled = false;
    }else if(numCheckedClientes == 0){
        BTN_EDIT_CLIENT.disabled = true;
        BTN_CARD_CLIENT.disabled = true;
        BTN_DELETE_CLIENT.disabled = true;
    }
}

function checkMascotas(numCheckedMascotas){
    if(numCheckedMascotas > 1){
        BTN_ADD_CONSULT_PET.disabled = true;
        BTN_EDIT_PET.disabled = true;
        BTN_DELETE_PET.disabled = false;
        BTN_SEE_HC_PET.disabled = true;
    }else if(numCheckedMascotas == 1){
        BTN_ADD_CONSULT_PET.disabled = false;
        BTN_EDIT_PET.disabled = false;
        BTN_DELETE_PET.disabled = false;
        BTN_SEE_HC_PET.disabled = false;
    }else if(numCheckedMascotas == 0){
        BTN_ADD_CONSULT_PET.disabled = true;
        BTN_EDIT_PET.disabled = true;
        BTN_DELETE_PET.disabled = true;
        BTN_SEE_HC_PET.disabled = true;
    }
}

if(FORM_ADD_CLIENT) {
    BTN_ADD_CLIENT.addEventListener('click', () => {
        FORM_ADD_CLIENT.classList.remove('oculto');
    });
}

if(FORM_ADD_PET) {
    BTN_ADD_PET.addEventListener('click', () => {
        FORM_ADD_PET.classList.remove('oculto');
    });
}

if(FORM_ADD_CONSULT_PET) {
    BTN_ADD_CONSULT_PET.addEventListener('click', () => {
        FORM_ADD_CONSULT_PET.classList.remove('oculto');
    });
}

if(FORM_ADD_USER) {
    BTN_ADD_USER.addEventListener('click', () => {
        FORM_ADD_USER.classList.remove('oculto');
    });
}

if(FORM_EDIT_CLIENT) {
    BTN_EDIT_CLIENT.addEventListener('click', () => {
        FORM_EDIT_CLIENT.classList.remove('oculto');
    });
}

if(FORM_EDIT_PET) {
    BTN_EDIT_PET.addEventListener('click', () => {
        FORM_EDIT_PET.classList.remove('oculto');
    });
}

if(FORM_EDIT_USER) {
    BTN_EDIT_USER.addEventListener('click', () => {
        FORM_EDIT_USER.classList.remove('oculto');
    });
}

if(BTN_CLOSE_FORM_ADD_CLIENT){
    BTN_CLOSE_FORM_ADD_CLIENT.addEventListener('click', () => {
        FORM_ADD_CLIENT.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_ADD_PET){
    BTN_CLOSE_FORM_ADD_PET.addEventListener('click', () => {
        FORM_ADD_PET.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_ADD_CONSULT_PET){
    BTN_CLOSE_FORM_ADD_CONSULT_PET.addEventListener('click', () => {
        FORM_ADD_CONSULT_PET.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_ADD_H_PET){
    BTN_CLOSE_FORM_ADD_H_PET.addEventListener('click', () => {
        FORM_ADD_H_PET.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_ADD_USER){
    BTN_CLOSE_FORM_ADD_USER.addEventListener('click', () => {
        FORM_ADD_USER.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_EDIT_CLIENT){
    BTN_CLOSE_FORM_EDIT_CLIENT.addEventListener('click', () => {
        FORM_EDIT_CLIENT.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_EDIT_PET){
    BTN_CLOSE_FORM_EDIT_PET.addEventListener('click', () => {
        FORM_EDIT_PET.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_EDIT_USER){
    BTN_CLOSE_FORM_EDIT_USER.addEventListener('click', () => {
        FORM_EDIT_USER.classList.add('oculto');
    });
}

if (FORM_DELETE_CLIENT) {
    BTN_DELETE_CLIENT.addEventListener('click', () => {
        FORM_DELETE_CLIENT.classList.remove('oculto');
        var contentExtrasCliente = document.createElement('div');
        contentExtrasCliente.setAttribute('id', 'content-extras-cliente');
        FORM_DELETE_CLIENT.appendChild(contentExtrasCliente);
        for (let i = 0; i < CHECK_CLIENT.length; i++) {
            if(CHECK_CLIENT[i].checked){
                var clienteEliminar = document.createElement('input');
                clienteEliminar.setAttribute('type', 'hidden');
                clienteEliminar.setAttribute('name', 'extras-cliente');
                clienteEliminar.setAttribute('value', CHECK_CLIENT[i].value);
                clienteEliminar.setAttribute('id', 'eliminar-cliente-' + CHECK_CLIENT[i].value);
                contentExtrasCliente.appendChild(clienteEliminar);
            }
        }
    });
}

if (FORM_CARD_CLIENT && BTN_CARD_CLIENT) {
    BTN_CARD_CLIENT.addEventListener('click', () => {
        FORM_CARD_CLIENT.classList.remove('oculto');
    })

    BTN_CLOSE_FORM_CARD_CLIENT.addEventListener('click', () => {
        FORM_CARD_CLIENT.classList.add('oculto');
        $('#tbl-client-emails tbody tr>td').remove();
    })

    BTN_ADD_CLIENT_EMAIL.addEventListener('click', () => {
        FORM_ADD_CLIENT_EMAIL.classList.remove('oculto');
    })

    BTN_CLOSE_FORM_ADD_CLIENT_EMAIL.addEventListener('click', () => {
        FORM_ADD_CLIENT_EMAIL.classList.add('oculto');
    })
    
    BTN_ADD_CLIENT_PHONE.addEventListener('click', () => {
        FORM_ADD_CLIENT_PHONE.classList.remove('oculto');
    })

    BTN_CLOSE_FORM_ADD_CLIENT_PHONE.addEventListener('click', () => {
        FORM_ADD_CLIENT_PHONE.classList.add('oculto');
    })
}

if (FORM_DELETE_PET) {
    BTN_DELETE_PET.addEventListener('click', () => {
        FORM_DELETE_PET.classList.remove('oculto');
    });
}

if (FORM_DELETE_USER) {
    BTN_DELETE_USER.addEventListener('click', () => {
        FORM_DELETE_USER.classList.remove('oculto');
        var contentExtrasUsuario = document.createElement('div');
        contentExtrasUsuario.setAttribute('id', 'content-extras-usuario');
        FORM_DELETE_USER.appendChild(contentExtrasUsuario);
        for (let i = 0; i < CHECK_USER.length; i++) {
            if(CHECK_USER[i].checked){
                var usuarioEliminar = document.createElement('input');
                usuarioEliminar.setAttribute('type', 'hidden');
                usuarioEliminar.setAttribute('name', 'extras-usuario');
                usuarioEliminar.setAttribute('value', CHECK_USER[i].value);
                usuarioEliminar.setAttribute('id', 'eliminar-usuario-' + CHECK_USER[i].value);
                contentExtrasUsuario.appendChild(usuarioEliminar);
            }
        }
    });
}

if (BTN_CLOSE_FORM_DELETE_CLIENT) {
    BTN_CLOSE_FORM_DELETE_CLIENT.addEventListener('click', () => {
        document.getElementById('content-extras-cliente').remove();
        FORM_DELETE_CLIENT.classList.add('oculto');
    });
}

if (BTN_CLOSE_FORM_DELETE_PET) {
    BTN_CLOSE_FORM_DELETE_PET.addEventListener('click', () => {
        FORM_DELETE_PET.classList.add('oculto');
    });
}

if (BTN_CLOSE_FORM_DELETE_USER) {
    BTN_CLOSE_FORM_DELETE_USER.addEventListener('click', () => {
        document.getElementById('content-extras-usuario').remove();
        FORM_DELETE_USER.classList.add('oculto');
    });
}




if (BTN_CLOSE_INFO) {
    for (let i = 0; i < BTN_CLOSE_INFO.length; i++) {
        BTN_CLOSE_INFO[i].addEventListener('click', () => {
            BTN_CLOSE_INFO[i].parentElement.parentElement.classList.add('none');
        });
    }
}

// document.addEventListener('DOMContentLoaded', () => {
//     alert('Página cargada');
// });
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
        BTN_DELETE_CLIENT.disabled = false;
    }else if(numCheckedClientes == 1){
        BTN_EDIT_CLIENT.disabled = false;
        BTN_DELETE_CLIENT.disabled = false;
    }else if(numCheckedClientes == 0){
        BTN_EDIT_CLIENT.disabled = true;
        BTN_DELETE_CLIENT.disabled = true;
    }
}

if(FORM_EDIT_USER) {
    BTN_EDIT_USER.addEventListener('click', () => {
        FORM_EDIT_USER.classList.remove('oculto');
    });
}

if(FORM_EDIT_CLIENT) {
    BTN_EDIT_CLIENT.addEventListener('click', () => {
        FORM_EDIT_CLIENT.classList.remove('oculto');
    });
}

if(BTN_CLOSE_FORM_EDIT_USER){
    BTN_CLOSE_FORM_EDIT_USER.addEventListener('click', () => {
        FORM_EDIT_USER.classList.add('oculto');
    });
}

if(BTN_CLOSE_FORM_EDIT_CLIENT){
    BTN_CLOSE_FORM_EDIT_CLIENT.addEventListener('click', () => {
        FORM_EDIT_CLIENT.classList.add('oculto');
    });
}
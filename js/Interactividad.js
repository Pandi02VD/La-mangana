checkAllClients.addEventListener('click', () => {
    if (checkAllClients.checked) {
        for (let i = 0; i < checkClient.length; i++) {
            checkClient[i].checked = true;
        }
    }else{
        for (let i = 0; i < checkClient.length; i++) {
            checkClient[i].checked = false;
        }
    }
});

checkAllUsers.addEventListener('click', () => {
    if (checkAllUsers.checked) {
        for (let i = 0; i < checkUser.length; i++) {
            checkUser[i].checked = true;
        }
    }else{
        for (let i = 0; i < checkUser.length; i++) {
            checkUser[i].checked = false;
        }
    }
});
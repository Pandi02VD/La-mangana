var horaActual = new Date().getHours();
if (document.getElementById("saludo")) {
    const SALUDO = document.getElementById("saludo");
}

var USERS_TABLE = document.getElementsByName("users-table");
var USER_STATUS = document.getElementsByName("user-status");
const CHECK_ALL_USERS = document.getElementById("check-all-users");
const CHECK_USER = document.getElementsByName("check-user");
const BTN_ADD_USER = document.getElementById("btn-add-user");
const BTN_EDIT_USER = document.getElementById("btn-edit-user");
const BTN_DELETE_USER = document.getElementById("btn-delete-user");
var BTN_C_DELETE_USER = document.getElementById("btn-C-delete-user");
const BTN_CLOSE_INFO = document.getElementsByName("btn-close-info");
const FORM_ADD_USER = document.getElementById('form-add-user');
const FORM_EDIT_USER = document.getElementById('form-edit-user');
var FORM_DELETE_USER = document.getElementById('form-delete-user');
const BTN_CLOSE_FORM_ADD_USER = document.getElementById('btn-close-form-add-user');
var extrasUsuario = document.getElementsByName('extras-usuario');
const BTN_CLOSE_FORM_EDIT_USER = document.getElementById('btn-close-form-edit-user');
const BTN_CLOSE_FORM_DELETE_USER = document.getElementById('btn-close-form-delete-user');

var CLIENTS_TABLE = document.getElementsByName("clients-table");
const CHECK_ALL_CLIENTS = document.getElementById("check-all-clients");
const CHECK_ALL_CLIENT_EMAILS = document.getElementById("check-all-client-emails");
const CHECK_ALL_CLIENT_PHONES = document.getElementById("check-all-client-phones");
const CHECK_ALL_CLIENT_ADDRESS = document.getElementById("check-all-client-address");
var CHECK_CLIENT = document.getElementsByName("check-client");
var CHECK_CLIENT_EMAIL = document.getElementsByName("check-client-email");
var CHECK_CLIENT_PHONE = document.getElementsByName("check-client-phone");
var CHECK_CLIENT_ADDRESS = document.getElementsByName("check-client-address");
const BTN_ADD_CLIENT = document.getElementById("btn-add-client");
const BTN_ADD_CLIENT_EMAIL = document.getElementById("btn-add-client-email");
const BTN_ADD_CLIENT_PHONE = document.getElementById("btn-add-client-phone");
const BTN_ADD_CLIENT_ADDRESS = document.getElementById("btn-add-client-address");
const BTN_EDIT_CLIENT = document.getElementById("btn-edit-client");
var BTN_EDIT_CLIENT_EMAIL = document.getElementById("btn-edit-client-email");
var BTN_EDIT_CLIENT_PHONE = document.getElementById("btn-edit-client-phone");
var BTN_EDIT_CLIENT_ADDRESS = document.getElementById("btn-edit-client-address");
var BTN_DELETE_CLIENT = document.getElementById("btn-delete-client");
var BTN_DELETE_CLIENT_EMAIL = document.getElementById("btn-delete-client-email");
var BTN_DELETE_CLIENT_PHONE = document.getElementById("btn-delete-client-phone");
var BTN_DELETE_CLIENT_ADDRESS = document.getElementById("btn-delete-client-address");
var BTN_C_DELETE_CLIENT = document.getElementById("btn-C-delete-client");
var BTN_C_DELETE_CLIENT_EMAIL = document.getElementById("btn-C-delete-client-email");
var BTN_C_DELETE_CLIENT_PHONE = document.getElementById("btn-C-delete-client-phone");
var BTN_C_DELETE_CLIENT_ADDRESS = document.getElementById("btn-C-delete-client-address");
const FORM_ADD_CLIENT = document.getElementById('form-add-client');
const FORM_ADD_CLIENT_EMAIL = document.getElementById('form-add-client-email');
const FORM_ADD_CLIENT_PHONE = document.getElementById('form-add-client-phone');
const FORM_ADD_CLIENT_ADDRESS = document.getElementById('form-add-client-address');
const FORM_EDIT_CLIENT = document.getElementById('form-edit-client');
const FORM_EDIT_CLIENT_EMAIL = document.getElementById('form-edit-client-email');
const FORM_EDIT_CLIENT_PHONE = document.getElementById('form-edit-client-phone');
const FORM_EDIT_CLIENT_ADDRESS = document.getElementById('form-edit-client-address');
var FORM_DELETE_CLIENT = document.getElementById('form-delete-client');
var FORM_DELETE_CLIENT_EMAIL = document.getElementById('form-delete-client-email');
var FORM_DELETE_CLIENT_PHONE = document.getElementById('form-delete-client-phone');
var FORM_DELETE_CLIENT_ADDRESS = document.getElementById('form-delete-client-address');
var FORM_CARD_CLIENT = document.getElementById('form-card-client');
var extrasCliente = document.getElementsByName('extras-cliente');
const BTN_CLOSE_FORM_ADD_CLIENT = document.getElementById('btn-close-form-add-client');
const BTN_CLOSE_FORM_ADD_CLIENT_EMAIL = document.getElementById('btn-close-form-add-client-email');
const BTN_CLOSE_FORM_ADD_CLIENT_PHONE = document.getElementById('btn-close-form-add-client-phone');
const BTN_CLOSE_FORM_ADD_CLIENT_ADDRESS = document.getElementById('btn-close-form-add-client-address');
const BTN_CLOSE_FORM_EDIT_CLIENT = document.getElementById('btn-close-form-edit-client');
const BTN_CLOSE_FORM_EDIT_CLIENT_EMAIL = document.getElementById('btn-close-form-edit-client-email');
const BTN_CLOSE_FORM_EDIT_CLIENT_PHONE = document.getElementById('btn-close-form-edit-client-phone');
const BTN_CLOSE_FORM_EDIT_CLIENT_ADDRESS = document.getElementById('btn-close-form-edit-client-address');
var BTN_CLOSE_FORM_DELETE_CLIENT = document.getElementById('btn-close-form-delete-client');
var BTN_CLOSE_FORM_DELETE_CLIENT_EMAIL = document.getElementById('btn-close-form-delete-client-email');
var BTN_CLOSE_FORM_DELETE_CLIENT_PHONE = document.getElementById('btn-close-form-delete-client-phone');
var BTN_CLOSE_FORM_DELETE_CLIENT_ADDRESS = document.getElementById('btn-close-form-delete-client-address');

var PETS_TABLE = document.getElementsByName("pets-table");
const CHECK_ALL_PETS = document.getElementById("check-all-pets");
var CHECK_PET = document.getElementsByName("check-pet");
const BTN_ADD_PET = document.getElementById("btn-add-pet");
const BTN_ADD_CONSULT_PET = document.getElementById("btn-add-Consult-pet");
const BTN_EDIT_PET = document.getElementById("btn-edit-pet");
const BTN_DELETE_PET = document.getElementById("btn-delete-pet");
const BTN_ADD_H_PET = document.getElementById("btn-add-H-pet");
const BTN_SEE_HC_PET = document.getElementById('btn-see-HC-pet');
const FORM_ADD_PET = document.getElementById('form-add-pet');
const FORM_ADD_CONSULT_PET = document.getElementById('form-add-Consult-pet');
const FORM_ADD_H_PET = document.getElementById('form-add-H-pet');
const FORM_EDIT_PET = document.getElementById('form-edit-pet');
var FORM_DELETE_PET = document.getElementById('form-delete-pet');
// var extrasMascota = document.getElementsByName('extras-mascota');
const BTN_CLOSE_FORM_ADD_PET = document.getElementById('btn-close-form-add-pet');
const BTN_CLOSE_FORM_ADD_CONSULT_PET = document.getElementById("btn-close-form-add-Consult-pet");
const BTN_CLOSE_FORM_ADD_H_PET = document.getElementById('btn-close-form-add-H-pet');
const BTN_CLOSE_FORM_EDIT_PET = document.getElementById('btn-close-form-edit-pet');
var BTN_CLOSE_FORM_DELETE_PET = document.getElementById('btn-close-form-delete-pet');
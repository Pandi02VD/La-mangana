var horaActual = new Date().getHours();
var numCheckedUsers = 0;
var numCheckedClients = 0;
var numCheckedPets = 0;
if (document.getElementById("saludo")) {
    const SALUDO = document.getElementById("saludo");
}

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
const BTN_CLOSE_FORM_EDIT_USER = document.getElementById('btn-close-form-edit-user');
const BTN_CLOSE_FORM_DELETE_USER = document.getElementById('btn-close-form-delete-user');

const CHECK_ALL_CLIENTS = document.getElementById("check-all-clients");
var CHECK_CLIENT = document.getElementsByName("check-client");
const BTN_ADD_CLIENT = document.getElementById("btn-add-client");
const BTN_EDIT_CLIENT = document.getElementById("btn-edit-client");
var BTN_DELETE_CLIENT = document.getElementById("btn-delete-client");
var BTN_C_DELETE_CLIENT = document.getElementById("btn-C-delete-client");
const FORM_ADD_CLIENT = document.getElementById('form-add-client');
const FORM_EDIT_CLIENT = document.getElementById('form-edit-client');
var FORM_DELETE_CLIENT = document.getElementById('form-delete-client');
var extrasCliente = document.getElementsByName('extras-cliente');
const BTN_CLOSE_FORM_ADD_CLIENT = document.getElementById('btn-close-form-add-client');
const BTN_CLOSE_FORM_EDIT_CLIENT = document.getElementById('btn-close-form-edit-client');
var BTN_CLOSE_FORM_DELETE_CLIENT = document.getElementById('btn-close-form-delete-client');

const CHECK_ALL_PETS = document.getElementById("check-all-pets");
var CHECK_PET = document.getElementsByName("check-pet");
const BTN_ADD_PET = document.getElementById("btn-add-pet");
const BTN_EDIT_PET = document.getElementById("btn-edit-pet");
const BTN_DELETE_PET = document.getElementById("btn-delete-pet");
const BTN_ADD_H_PET = document.getElementById("btn-add-H-pet");
const BTN_ADD_HC_PET = document.getElementById('btn-add-HC-pet');
const BTN_ADD_E_PET = document.getElementById("btn-add-E-pet");
const FORM_ADD_PET = document.getElementById('form-add-pet');
const FORM_ADD_H_PET = document.getElementById('form-add-H-pet');
const FORM_EDIT_PET = document.getElementById('form-edit-pet');
var FORM_DELETE_PET = document.getElementById('form-delete-pet');
// var extrasMascota = document.getElementsByName('extras-mascota');
const BTN_CLOSE_FORM_ADD_PET = document.getElementById('btn-close-form-add-pet');
const BTN_CLOSE_FORM_ADD_H_PET = document.getElementById('btn-close-form-add-H-pet');
const BTN_CLOSE_FORM_EDIT_PET = document.getElementById('btn-close-form-edit-pet');
var BTN_CLOSE_FORM_DELETE_PET = document.getElementById('btn-close-form-delete-pet');
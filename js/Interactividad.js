if (document.getElementById('pet-anos-new')) {
	let edadMascota = document.getElementById('pet-anos-new');
	edadMascota.addEventListener('keyup', () => {
		let fechaActual = new Date();
		fecha = fechaActual.getFullYear() - edadMascota.value;
		document.getElementById('pet-edad-new').value = fecha;
		document.getElementById('span-edad-new').innerText = fecha;
	});
}

function interactFormModal (buttonShow, buttonHide, form) {
	if (buttonShow && form && buttonHide) {
		buttonShow.addEventListener('click', () => {
			form.classList.remove('oculto');
			$('body, html').animate({scrollTop: '0px'}, 300);
		});
		buttonHide.addEventListener('click', () => {
			form.classList.add('oculto');
		});
	}
}

function toogleCheck (elementCheck, elementsCheck, checkAll, btnsCheck, btnsCheckOnce) {
	if (elementCheck.checked) {
		elementCheck.checked = true;
	} else {
		elementCheck.checked = false;
	}

	let counterCheck = 0;
	for (let i = 0; i < elementsCheck.length; i++) {
		if (elementsCheck[i].checked) {
			counterCheck++;
		}
	}

	if (counterCheck > 1) {
		counterCheck === elementsCheck.length ? checkAll.checked = true : checkAll.checked = false;
		if (NodeList.prototype.isPrototypeOf(btnsCheck)) {
			for (let i = 0; i < btnsCheck.length; i++) {
				btnsCheck[i].disabled = false;
			}
		} else {
			btnsCheck.disabled = false;
		}

		if (NodeList.prototype.isPrototypeOf(btnsCheckOnce)) {
			for (let i = 0; i < btnsCheckOnce.length; i++) {
				btnsCheckOnce[i].disabled = true;
			}
		} else {
			btnsCheckOnce.disabled = true;
		}
	} else if (counterCheck === 1) {
		checkAll.checked = false;
		if (NodeList.prototype.isPrototypeOf(btnsCheck)) {
			for (let i = 0; i < btnsCheck.length; i++) {
				btnsCheck[i].disabled = false;
			}
		} else {
			btnsCheck.disabled = false;
		}

		if (NodeList.prototype.isPrototypeOf(btnsCheckOnce)) {
			for (let i = 0; i < btnsCheckOnce.length; i++) {
				btnsCheckOnce[i].disabled = false;
			}
		} else {
			btnsCheckOnce.disabled = false;
		}
	} else if (counterCheck === 0) {
		checkAll.checked = false;
		if (NodeList.prototype.isPrototypeOf(btnsCheck)) {
			for (let i = 0; i < btnsCheck.length; i++) {
				btnsCheck[i].disabled = true;
			}
		} else {
			btnsCheck.disabled = true;
		}

		if (NodeList.prototype.isPrototypeOf(btnsCheckOnce)) {
			for (let i = 0; i < btnsCheckOnce.length; i++) {
				btnsCheckOnce[i].disabled = true;
			}
		} else {
			btnsCheckOnce.disabled = true;
		}
	}
}

function toogleButtons (elementCheck, btnsCheck, btnsCheckOnce) {
	if (NodeList.prototype.isPrototypeOf(btnsCheck)) {
		for (let i = 0; i < btnsCheck.length; i++) {
			elementCheck.checked ? btnsCheck[i].disabled = false : btnsCheck[i].disabled = true;
		}
	} else {
		elementCheck.checked ? btnsCheck.disabled = false : btnsCheck.disabled = true;
	}

	if (NodeList.prototype.isPrototypeOf(btnsCheckOnce)) {
		for (let i = 0; i < btnsCheckOnce.length; i++) {
			btnsCheckOnce[i].disabled = true;
		}
	} else {
		btnsCheckOnce.disabled = true;
	}
}

function checkBox (checkTh, checkTd, btnsCheckOnce, btnsCheck) {
	if (checkTh && checkTd && btnsCheckOnce && btnsCheck) {
		checkTh.addEventListener ('click', () => {
			toogleButtons(checkTh, btnsCheck, btnsCheckOnce);

			for (let i = 0; i < checkTd.length; i++) {
				if (checkTh.checked) {
					checkTd[i].checked = true;
				} else if (! checkTh.checked) {
					checkTd[i].checked = false;
				}
			}
		});
		
		for (let i = 0; i < checkTd.length; i++) {
			checkTd[i].addEventListener ('click', () => {
				toogleCheck(checkTd[i], checkTd, checkTh, btnsCheck, btnsCheckOnce);
			});
		}
	}
}

function setAttr (element, attribute, value) {
	if (element) {
		element.setAttribute(attribute, value);
	}
}

function tableCellValues(tableCell, url) {
	if (tableCell) {
		for (let i = 0; i < tableCell.length; i++) {
			tableCell[i].addEventListener('click', () => {
				let idValueTable = tableCell[i].getAttribute('id');
				window.location = url + idValueTable;
			})
		}
	}
}

function tags(textarea) {
	if (textarea) {
		textarea.addEventListener('keyup', () => {
			let textInput = textarea.value;
			let splitString = textInput.split(',');
			if (splitString.length > 1) {
				let inputHidden = document.createElement('input');
				let div = document.createElement('div');
				let btn = document.createElement('div');
				
				inputHidden.setAttribute('type', 'hidden');
				inputHidden.setAttribute('name', 'tags');
				div.setAttribute('class', 'tag');
				btn.setAttribute('name', 'btns-close-tag');
				btn.setAttribute('class', 'tag__close');

				div.innerText = splitString[0];
				inputHidden.value = splitString[0];
				console.log(inputHidden.value);
				btn.innerText = 'x';
				closeTags(btn);
				div.appendChild(btn);
				div.appendChild(inputHidden);
				textarea.parentElement.appendChild(div);
				textarea.value = '';
			}
		})
	}
}

function closeTags(btn) {
	if (btn) {
		btn.addEventListener('click', () => {
			btn.parentElement.remove();
		});
	}
}

function callForm(checkbox, form) {
	if (checkbox && form) {
		checkbox.addEventListener('click', () => {
			if (checkbox.checked) {
				form.setAttribute('name', 'ready');
			} else {
				form.setAttribute('name', 'form');
			}
		});
	}
}

function momentoActual(element){
	if (element) {
		setInterval(() => {
			let ahora = new Date();
			element.innerText = "Registro: " + ahora.getDate() + " de " + ahora.toLocaleString('es-mx', { month: 'long' }) + " de " + ahora.getFullYear() + " - " + ahora.getHours() + ":" + ahora.getMinutes() + ":" + ahora.getSeconds()
		}, 1000);
	}
}

tableCellValues(USERS_TABLE, 'index.php?pagina=Usuario&uu=');
tableCellValues(CLIENTS_TABLE, 'index.php?pagina=Cliente&uc=');
tableCellValues(PETS_TABLE, 'index.php?pagina=Mascota&um=');

checkBox(CHECK_ALL_CLIENTS, CHECK_CLIENT, BTN_EDIT_CLIENT, BTN_DELETE_CLIENT);

setAttr(BTN_EDIT_CLIENT_EMAIL, 'name', 'btns-one-check-client-email');
setAttr(BTN_ASMAIN_CLIENT_EMAIL, 'name', 'btns-one-check-client-email');
let btnsOneCheckClientEmail = document.getElementsByName('btns-one-check-client-email');
checkBox(CHECK_ALL_CLIENT_EMAILS, CHECK_CLIENT_EMAIL, btnsOneCheckClientEmail, BTN_DELETE_CLIENT_EMAIL);

setAttr(BTN_EDIT_CLIENT_PHONE, 'name', 'btns-one-check-client-phone');
setAttr(BTN_ASMAIN_CLIENT_PHONE, 'name', 'btns-one-check-client-phone');
let btnsOneCheckClientPhone = document.getElementsByName('btns-one-check-client-phone');
checkBox(CHECK_ALL_CLIENT_PHONES, CHECK_CLIENT_PHONE, btnsOneCheckClientPhone, BTN_DELETE_CLIENT_PHONE);

setAttr(BTN_EDIT_CLIENT_ADDRESS, 'name', 'btns-one-check-client-address');
setAttr(BTN_ASMAIN_CLIENT_ADDRESS, 'name', 'btns-one-check-client-address');
let btnsOneCheckClientAddress = document.getElementsByName('btns-one-check-client-address');
checkBox(CHECK_ALL_CLIENT_ADDRESS, CHECK_CLIENT_ADDRESS, btnsOneCheckClientAddress, BTN_DELETE_CLIENT_ADDRESS);

checkBox(CHECK_ALL_USERS, CHECK_USER, BTN_EDIT_USER, BTN_DELETE_USER);
checkBox(CHECK_ALL_USER_EMAILS, CHECK_USER_EMAIL, BTN_EDIT_USER_EMAIL, BTN_DELETE_USER_EMAIL);
checkBox(CHECK_ALL_USER_PHONES, CHECK_USER_PHONE, BTN_EDIT_USER_PHONE, BTN_DELETE_USER_PHONE);
checkBox(CHECK_ALL_USER_ADDRESS, CHECK_USER_ADDRESS, BTN_EDIT_USER_ADDRESS, BTN_DELETE_USER_ADDRESS);

setAttr(BTN_EDIT_PET, 'name', 'btns-one-check-pet');
setAttr(BTN_ADD_CONSULT_PET, 'name', 'btns-one-check-pet');
setAttr(BTN_SEE_HC_PET, 'name', 'btns-one-check-pet');
let btnsOneCheckPet = document.getElementsByName('btns-one-check-pet');
checkBox(CHECK_ALL_PETS, CHECK_PET, btnsOneCheckPet, BTN_DELETE_PET);
checkBox(CHECK_ALL_JAULAS, CHECK_JAULA, BTN_EDIT_JAULA, BTN_DELETE_JAULA);
checkBox(CHECK_ALL_RAZAS, CHECK_RAZA, BTN_EDIT_RAZA, BTN_DELETE_RAZA);

interactFormModal(BTN_ADD_USER, BTN_CLOSE_FORM_ADD_USER, FORM_ADD_USER);
interactFormModal(BTN_ADD_CLIENT, BTN_CLOSE_FORM_ADD_CLIENT, FORM_ADD_CLIENT);
interactFormModal(BTN_ADD_CLIENT_EMAIL, BTN_CLOSE_FORM_ADD_CLIENT_EMAIL, FORM_ADD_CLIENT_EMAIL);
interactFormModal(BTN_ADD_CLIENT_PHONE, BTN_CLOSE_FORM_ADD_CLIENT_PHONE, FORM_ADD_CLIENT_PHONE);
interactFormModal(BTN_ADD_CLIENT_ADDRESS, BTN_CLOSE_FORM_ADD_CLIENT_ADDRESS, FORM_ADD_CLIENT_ADDRESS);
interactFormModal(BTN_ADD_USER_EMAIL, BTN_CLOSE_FORM_ADD_USER_EMAIL, FORM_ADD_USER_EMAIL);
interactFormModal(BTN_ADD_USER_PHONE, BTN_CLOSE_FORM_ADD_USER_PHONE, FORM_ADD_USER_PHONE);
interactFormModal(BTN_ADD_USER_ADDRESS, BTN_CLOSE_FORM_ADD_USER_ADDRESS, FORM_ADD_USER_ADDRESS);
interactFormModal(BTN_ADD_PET, BTN_CLOSE_FORM_ADD_PET, FORM_ADD_PET);
interactFormModal(BTN_ADD_CONSULT_PET, BTN_CLOSE_FORM_ADD_CONSULT_PET, FORM_ADD_CONSULT_PET);
interactFormModal(BTN_ADD_JAULA, BTN_CLOSE_FORM_ADD_JAULA, FORM_ADD_JAULA);
interactFormModal(BTN_ADD_RAZA, BTN_CLOSE_FORM_ADD_RAZA, FORM_ADD_RAZA);

interactFormModal(BTN_EDIT_USER, BTN_CLOSE_FORM_EDIT_USER, FORM_EDIT_USER);
interactFormModal(BTN_EDIT_CLIENT, BTN_CLOSE_FORM_EDIT_CLIENT, FORM_EDIT_CLIENT);
interactFormModal(BTN_EDIT_CLIENT_EMAIL, BTN_CLOSE_FORM_EDIT_CLIENT_EMAIL, FORM_EDIT_CLIENT_EMAIL);
interactFormModal(BTN_EDIT_CLIENT_PHONE, BTN_CLOSE_FORM_EDIT_CLIENT_PHONE, FORM_EDIT_CLIENT_PHONE);
interactFormModal(BTN_EDIT_CLIENT_ADDRESS, BTN_CLOSE_FORM_EDIT_CLIENT_ADDRESS, FORM_EDIT_CLIENT_ADDRESS);
interactFormModal(BTN_EDIT_USER_EMAIL, BTN_CLOSE_FORM_EDIT_USER_EMAIL, FORM_EDIT_USER_EMAIL);
interactFormModal(BTN_EDIT_USER_PHONE, BTN_CLOSE_FORM_EDIT_USER_PHONE, FORM_EDIT_USER_PHONE);
interactFormModal(BTN_EDIT_USER_ADDRESS, BTN_CLOSE_FORM_EDIT_USER_ADDRESS, FORM_EDIT_USER_ADDRESS);
interactFormModal(BTN_EDIT_PET, BTN_CLOSE_FORM_EDIT_PET, FORM_EDIT_PET);
interactFormModal(BTN_EDIT_JAULA, BTN_CLOSE_FORM_EDIT_JAULA, FORM_EDIT_JAULA);
interactFormModal(BTN_EDIT_RAZA, BTN_CLOSE_FORM_EDIT_RAZA, FORM_EDIT_RAZA);

interactFormModal(BTN_DELETE_CLIENT, BTN_CLOSE_FORM_DELETE_CLIENT, FORM_DELETE_CLIENT);
interactFormModal(BTN_DELETE_USER, BTN_CLOSE_FORM_DELETE_USER, FORM_DELETE_USER);
interactFormModal(BTN_DELETE_PET, BTN_CLOSE_FORM_DELETE_PET, FORM_DELETE_PET);
interactFormModal(BTN_DELETE_CLIENT_EMAIL, BTN_CLOSE_FORM_DELETE_CLIENT_EMAIL, FORM_DELETE_CLIENT_EMAIL);
interactFormModal(BTN_DELETE_CLIENT_PHONE, BTN_CLOSE_FORM_DELETE_CLIENT_PHONE, FORM_DELETE_CLIENT_PHONE);
interactFormModal(BTN_DELETE_CLIENT_ADDRESS, BTN_CLOSE_FORM_DELETE_CLIENT_ADDRESS, FORM_DELETE_CLIENT_ADDRESS);
interactFormModal(BTN_DELETE_USER_EMAIL, BTN_CLOSE_FORM_DELETE_USER_EMAIL, FORM_DELETE_USER_EMAIL);
interactFormModal(BTN_DELETE_USER_PHONE, BTN_CLOSE_FORM_DELETE_USER_PHONE, FORM_DELETE_USER_PHONE);
interactFormModal(BTN_DELETE_USER_ADDRESS, BTN_CLOSE_FORM_DELETE_USER_ADDRESS, FORM_DELETE_USER_ADDRESS);
interactFormModal(BTN_DELETE_JAULA, BTN_CLOSE_FORM_DELETE_JAULA, FORM_DELETE_JAULA);
interactFormModal(BTN_DELETE_RAZA, BTN_CLOSE_FORM_DELETE_RAZA, FORM_DELETE_RAZA);

interactFormModal(BTN_CHANGE_PASSWORD, BTN_CLOSE_FORM_CHANGE_PASSWORD, FORM_CHANGE_PASSWORD);

interactFormModal(BTN_ASMAIN_CLIENT_EMAIL, BTN_CLOSE_FORM_ASMAIN_CLIENT_ELEMENT, FORM_ASMAIN_CLIENT_ELEMENT);
interactFormModal(BTN_ASMAIN_CLIENT_PHONE, BTN_CLOSE_FORM_ASMAIN_CLIENT_ELEMENT, FORM_ASMAIN_CLIENT_ELEMENT);
interactFormModal(BTN_ASMAIN_CLIENT_ADDRESS, BTN_CLOSE_FORM_ASMAIN_CLIENT_ELEMENT, FORM_ASMAIN_CLIENT_ELEMENT);

tags(document.getElementById('acs-consult-new'));
callForm(document.getElementById('service-H-consult-new'), document.getElementById('form-add-H-pet'));
callForm(document.getElementById('service-C-consult-new'), document.getElementById('form-add-C-pet'));
callForm(document.getElementById('service-M-consult-new'), document.getElementById('form-add-M-pet'));

// momentoActual(document.getElementById('momento-consulta-new'));

if(BTN_CLOSE_FORM_ADD_H_PET){
	BTN_CLOSE_FORM_ADD_H_PET.addEventListener('click', () => {
		FORM_ADD_H_PET.classList.add('oculto');
	});
}

if (BTN_CLOSE_INFO) {
	for (let i = 0; i < BTN_CLOSE_INFO.length; i++) {
		BTN_CLOSE_INFO[i].addEventListener('click', () => {
			BTN_CLOSE_INFO[i].parentElement.parentElement.classList.add('none');
		});
	}
}

if (document.getElementById('service-H-consult-new')) {
	let element = document.getElementById('service-H-consult-new');
	let more = document.getElementById('lbl-service-C-consult-new');
	let other = document.getElementById('lbl-service-M-consult-new');
	element.addEventListener('click', () => {
		if (element.checked) {
			more.classList.remove('none');
			other.innerText = 'Medicación';
		} else {
			more.classList.add('none');
			other.innerText = 'Solo Medicación';
		}
	});
}
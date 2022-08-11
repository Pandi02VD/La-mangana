import JQueryAcciones from "./JQueryAcciones.js";

export default class Interactividad {
	static ajuste() {
		document.querySelector('main').classList.add('ajuste');
	}

	static stepSlide(slider) {
		let firstSlide = document.querySelectorAll('.slide')[0];
		slider.style.marginLeft = '-200%';
		slider.style.transition = 'all .5s';
		setTimeout(() => {
			slider.style.transition = 'none';
			slider.insertAdjacentElement('beforeend', firstSlide);
			slider.style.marginLeft = '-100%';
		}, 500);
	}

	static sliderControls(prev, next, items, slider) {
		let lastSlide = items[items.length - 1];
		slider.insertAdjacentElement('afterbegin', lastSlide);
		next.addEventListener('click', () => {Interactividad.stepSlide(slider)});
		prev.addEventListener('click', () => {
			let items = document.querySelectorAll('.slide');
			let lastSlide = items[items.length - 1];
			slider.style.marginLeft = '0%';
			slider.style.transition = 'all .5s';
			setTimeout(() => {
				slider.style.transition = 'none';
				slider.insertAdjacentElement('afterbegin', lastSlide);
				slider.style.marginLeft = '-100%';
			}, 500);
		});
	}
	
	static confirmarCita(nameRequest, btnC, callback) {
		if (btnC) {
			for (const i of btnC) {
				i.addEventListener('click', () => {
					JQueryAcciones.editFormModal(
						i.parentElement.getAttribute('id'), 
						nameRequest, 
						(r) => {
							callback(r);
						}
					);
					// Crear la tabla expediente y normalizar.
					// Para iniciar el expediente, llenar en forma física y digital el formato de Historia Medica ECO.docx
				});
			}
		}
	}

	static itemsTable(items) {
		items.forEach(i => {
			i.addEventListener('click', (e) => {
				let obj = i.parentElement.children;
				// console.log(i.firstElementChild);
				let td = i.firstElementChild;
				let tdStatus = false;
				if(td != null) {
					td.getAttribute('type') == 'button' ? tdStatus = true : tdStatus = false;
				}
				if (!tdStatus) {
					for (const key in obj) {
						key > 2 ? obj[key].classList.toggle('block') : null ;
					}
				}
			});
		});
	}
	
	static interactDiv (buttonShow, divs, div) {
		if (buttonShow && divs && div) {
			buttonShow.addEventListener('click', () => {
				divs.forEach(element => {element.classList.add('none')});
				div.classList.remove('none');
			});
		}
	}
	
	static interactFormModal (buttonShow, buttonHide, form) {
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
	
	static interactFormModalSecret (buttonHide, form) {
		if (form && buttonHide) {
			buttonHide.addEventListener('click', () => {
				form.classList.add('oculto');
			});
		}
	}

	static formModal (buttonsShow, buttonHide, form, callback) {
		if (buttonsShow && buttonHide && form) {
			buttonsShow.forEach( element => {
				element.addEventListener('click', () => {
					form.classList.remove('oculto');
					$('body, html').animate({scrollTop: '0px'}, 300);
					callback(
						element.getAttribute('id'), 
						element.getAttribute('name')
					);
				});
			});
			buttonHide.addEventListener('click', () => {
				form.classList.add('oculto');
			});
		}
	}
	
	static toggleCheck (elementCheck, elementsCheck, checkAll, btnsCheck, btnsCheckOnce) {
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
	
	static toogleButtons (elementCheck, btnsCheck, btnsCheckOnce) {
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
	
	static checkBox (checkTh, checkTd, btnsCheckOnce, btnsCheck) {
		if (checkTh && checkTd && btnsCheckOnce && btnsCheck) {
			checkTh.addEventListener ('click', () => {
				Interactividad.toogleButtons(checkTh, btnsCheck, btnsCheckOnce);
	
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
					Interactividad.toggleCheck(checkTd[i], checkTd, checkTh, btnsCheck, btnsCheckOnce);
				});
			}
		}
	}
	
	static setAttr (element, attribute, value) {
		if (element) {
			element.setAttribute(attribute, value);
		}
	}
	
	static tableCellValues(tableCell, url) {
		if (tableCell) {
			for (let i = 0; i < tableCell.length; i++) {
				tableCell[i].addEventListener('click', () => {
					let idValueTable = tableCell[i].getAttribute('id');
					window.location = url + idValueTable;
				})
			}
		}
	}
	
	static tags(textarea) {
		if (textarea) {
			textarea.addEventListener('keyup', () => {
				let textInput = textarea.value;
				let splitString = textInput.split(',');
				if (splitString.length > 1) {
					let inputHidden = document.creattdement('input');
					let div = document.createElement('div');
					let btn = document.createElement('div');
					
					inputHidden.setAttribute('type', 'hidden');
					inputHidden.setAttribute('name', 'tags[]');
					div.setAttribute('class', 'tag');
					btn.setAttribute('name', 'btns-close-tag');
					btn.setAttribute('class', 'tag__close');
	
					div.innerText = splitString[0];
					inputHidden.value = splitString[0];
					console.log(inputHidden.value);
					btn.innerText = 'x';
					Interactividad.closeTags(btn);
					div.appendChild(btn);
					div.appendChild(inputHidden);
					textarea.parentNode.appendChild(div);
					textarea.value = '';
				}
			})
		}
	}
	
	static closeTags(btn) {
		if (btn) {
			btn.addEventListener('click', () => {
				btn.parentNode.remove();
			});
		}
	}
	
	static callForm(checkbox, callback) {
		if (checkbox) {
			checkbox.addEventListener('click', () => {
				callback();
			});
		}
	}
	
	static momentoActual(element){
		if (element) {
			setInterval(() => {
				let ahora = new Date();
				element.innerText = "Registro: " + ahora.getDate() + " de " + ahora.toLocaleString('es-mx', { month: 'long' }) + " de " + ahora.getFullYear() + " - " + ahora.getHours() + ":" + ahora.getMinutes() + ":" + ahora.getSeconds()
			}, 1000);
		}
	}
}

// if (document.getElementById('pet-anos-new')) {
// 	let edadMascota = document.getElementById('pet-anos-new');
// 	edadMascota.addEventListener('keyup', () => {
// 		let fechaActual = new Date();
// 		fecha = fechaActual.getFullYear() - edadMascota.value;
// 		document.getElementById('pet-edad-new').value = fecha;
// 		document.getElementById('span-edad-new').innerText = fecha;
// 	});
// }

// if (document.getElementById('pet-anos-edit')) {
// 	let edadMascota = document.getElementById('pet-anos-edit');
// 	edadMascota.addEventListener('keyup', () => {
// 		let fechaActual = new Date();
// 		fecha = fechaActual.getFullYear() - edadMascota.value;
// 		document.getElementById('pet-edad-edit').value = fecha;
// 		document.getElementById('span-edad-edit').innerText = fecha;
// 	});
// }

// tableCellValues(USERS_TABLE, 'index.php?pagina=Usuario&uu=');
// tableCellValues(CLIENTS_TABLE, 'index.php?pagina=Cliente&uc=');
// tableCellValues(PETS_TABLE, 'index.php?pagina=Mascota&um=');

// setAttr(BTN_EDIT_CLIENT_EMAIL, 'name', 'btns-one-check-client-email');
// setAttr(BTN_ASMAIN_EMAIL, 'name', 'btns-one-check-client-email');
// let btnsOneCheckClientEmail = document.getElementsByName('btns-one-check-client-email');
// checkBox(CHECK_ALL_CLIENT_EMAILS, CHECK_CLIENT_EMAIL, btnsOneCheckClientEmail, BTN_DELETE_CLIENT_EMAIL);

// setAttr(BTN_EDIT_CLIENT_PHONE, 'name', 'btns-one-check-client-phone');
// setAttr(BTN_ASMAIN_PHONE, 'name', 'btns-one-check-client-phone');
// let btnsOneCheckClientPhone = document.getElementsByName('btns-one-check-client-phone');
// checkBox(CHECK_ALL_CLIENT_PHONES, CHECK_CLIENT_PHONE, btnsOneCheckClientPhone, BTN_DELETE_CLIENT_PHONE);

// setAttr(BTN_EDIT_CLIENT_ADDRESS, 'name', 'btns-one-check-client-address');
// setAttr(BTN_ASMAIN_ADDRESS, 'name', 'btns-one-check-client-address');
// let btnsOneCheckClientAddress = document.getElementsByName('btns-one-check-client-address');
// checkBox(CHECK_ALL_CLIENT_ADDRESS, CHECK_CLIENT_ADDRESS, btnsOneCheckClientAddress, BTN_DELETE_CLIENT_ADDRESS);

// checkBox(CHECK_ALL_USERS, CHECK_USER, BTN_EDIT_USER, BTN_DELETE_USER);

// let urla = window.location.search;
// let paginal = new URLSearchParams(urla).get('pagina');
// if (paginal == 'Usuario') {
// 	setAttr(BTN_EDIT_CLIENT_EMAIL, 'name', 'btns-one-check-user-email');
// 	setAttr(BTN_ASMAIN_EMAIL, 'name', 'btns-one-check-user-email');
// 	let btnsOneCheckUserEmail = document.getElementsByName('btns-one-check-user-email');
// 	checkBox(CHECK_ALL_USER_EMAILS, CHECK_USER_EMAIL, btnsOneCheckUserEmail, BTN_DELETE_USER_EMAIL);

// 	setAttr(BTN_EDIT_CLIENT_EMAIL, 'name', 'btns-one-check-user-phone');
// 	setAttr(BTN_ASMAIN_PHONE, 'name', 'btns-one-check-user-phone');
// 	let btnsOneCheckUserPhone = document.getElementsByName('btns-one-check-user-phone');
// 	checkBox(CHECK_ALL_USER_PHONES, CHECK_USER_PHONE, btnsOneCheckUserPhone, BTN_DELETE_USER_PHONE);

// 	setAttr(BTN_EDIT_CLIENT_EMAIL, 'name', 'btns-one-check-user-address');
// 	setAttr(BTN_ASMAIN_ADDRESS, 'name', 'btns-one-check-user-address');
// 	let btnsOneCheckUserAddress = document.getElementsByName('btns-one-check-user-address');
// 	checkBox(CHECK_ALL_USER_ADDRESS, CHECK_USER_ADDRESS, btnsOneCheckUserAddress, BTN_DELETE_USER_ADDRESS);
// }

// setAttr(BTN_EDIT_PET, 'name', 'btns-one-check-pet');
// setAttr(BTN_ADD_CONSULT_PET, 'name', 'btns-one-check-pet');
// setAttr(BTN_SEE_HC_PET, 'name', 'btns-one-check-pet');
// let btnsOneCheckPet = document.getElementsByName('btns-one-check-pet');
// checkBox(CHECK_ALL_PETS, CHECK_PET, btnsOneCheckPet, BTN_DELETE_PET);
// checkBox(CHECK_ALL_JAULAS, CHECK_JAULA, BTN_EDIT_JAULA, BTN_DELETE_JAULA);
// checkBox(CHECK_ALL_RAZAS, CHECK_RAZA, BTN_EDIT_RAZA, BTN_DELETE_RAZA);

// tags(document.getElementById('acs-consult-new'));

// if (BTN_CLOSE_INFO) {
// 	for (let i = 0; i < BTN_CLOSE_INFO.length; i++) {
// 		BTN_CLOSE_INFO[i].addEventListener('click', () => {
// 			BTN_CLOSE_INFO[i].parentElement.parentElement.classList.add('none');
// 		});
// 	}
// }

// let checkHos = document.getElementById('service-H-consult-new');
// let checkCir = document.getElementById('service-C-consult-new');
// let checkMed = document.getElementById('service-M-consult-new');
// let lblMed = document.getElementById('lbl-service-M-consult-new');
// let lblCir = document.getElementById('lbl-service-C-consult-new');

// callForm(checkHos, () => {
// 	if (checkHos.checked) {
// 		lblCir.classList.remove('none');
// 		lblMed.innerText = 'Medicación';
// 		if(checkMed.checked) {
// 			checkMed.checked = false; 
// 		}
// 	} else {
// 		lblCir.classList.add('none');
// 		lblMed.innerText = 'Solo Medicación';
// 		checkCir.checked = false;
// 		checkMed.checked = false;
// 	}
// });

// function prescription(nombre, dosis, unidad, frecuencia, add) {
// 	if (nombre && dosis && frecuencia && add) {
// 		add.addEventListener('click', () => {
// 			if (
// 				nombre.value.length != 0 && 
// 				dosis.value.length != 0 && 
// 				frecuencia.value.length != 0
// 			) {
// 				let fragment = new DocumentFragment();
// 				let template = document.getElementById('medic-template');
// 				let list = document.getElementById('list');
				
// 				const clone = template.content.firstElementChild.cloneNode(true);
// 				let textMedical = 
// 					nombre.value + ', ' + 
// 					dosis.value + ' ' +
// 					unidad[unidad.selectedIndex].textContent + ' ' +
// 					frecuencia.value;
// 				clone.querySelector('[name="nombre"]').textContent = textMedical;
// 				clone.querySelector('[name="medical-M-new[]"]').value = textMedical;
// 				clone.querySelector('[name="drop"]').addEventListener('click', () => {
// 					clone.remove();
// 				});
// 				fragment.appendChild(clone);
// 				list.appendChild(fragment);
// 				nombre.value = '';
// 				dosis.value = '';
// 				unidad.options[0].selected = true;
// 				frecuencia.value = '';
// 			} else {
// 				nombre.focus();
// 			}
// 		});
// 	}
// }

// prescription(
// 	document.getElementById('nombre-M-new'), 
// 	document.getElementById('dosis-M-new'), 
// 	document.getElementById('unidad-M-new'), 
// 	document.getElementById('frecuencia-M-new'), 
// 	document.getElementById('add-M-new')
// );
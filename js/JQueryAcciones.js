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

function elementChecked (checkElement) {
	if (checkElement) {
		var recordChosen;
		for (let i = 0; i < checkElement.length; i++) {
			if (checkElement[i].checked) {
				recordChosen = checkElement[i].value;
			}
		}
		return recordChosen;
	} else {
		return;
	}
}

function addElementsChoosen (elements, form) {
	var containerElementsChoosen = document.createElement('div');
	containerElementsChoosen.setAttribute('id', 'container-elements-choosen');
	form.appendChild(containerElementsChoosen);

	for (let i = 0; i < elements.length; i++) {
		if (elements[i].checked) {
			let elementToDelete = document.createElement('input');
			elementToDelete.setAttribute('type', 'hidden');
			elementToDelete.setAttribute('name', 'element-to-delete');
			elementToDelete.setAttribute('value', elements[i].value);
			elementToDelete.setAttribute('id', 'element-to-delete-' + elements[i].value);
			containerElementsChoosen.appendChild(elementToDelete);
		}
	}
}

function removeElementsChoosen () {
	document.getElementById('container-elements-choosen').remove();
}

function editForm (btnShowFormEdit, checkElement, inputId, callback) {
	if (btnShowFormEdit) {
		$(btnShowFormEdit).click(function (){
			let recordId = elementChecked(checkElement);
			inputId.val(recordId);
			let nameRequest = inputId.attr('id');

			let formData = new FormData();
			formData.append(nameRequest, recordId);

			$.ajax({
				url: 'controlador/Ajax.php', 
				method: 'post', 
				data: formData, 
				cache: false, 
				contentType: false, 
				processData: false, 
				dataType: 'json', 
				success: function (response) {
					if (response) {
						callback(response);
					}
				}
			});
		});
	}
}

function deleteForm (btnShowFormDelete, btnConfirmDelete, btnCloseForm, checkElements, form, module, view) {
	if (btnShowFormDelete && btnCloseForm && btnConfirmDelete && form) {
		$(btnShowFormDelete).click(function () {
			addElementsChoosen(checkElements, form);
		});

		$(btnConfirmDelete).click(function () {
			$(form).css('cursor', 'progress');
			$(btnCloseForm).css('cursor', 'progress');
			$(btnConfirmDelete).css('cursor', 'progress');
			btnCloseForm.disabled = true;
			btnConfirmDelete.disabled = true;
			$(btnConfirmDelete).attr('value', 'Eliminando...');
			
			let elementsToDelete = new Array();
			for (let i = 0; i < checkElements.length; i++) {
				if (checkElements[i].checked) {
					elementsToDelete.push(checkElements[i].value);
				}
			}

			let elementsToDeleteJSON = JSON.stringify(elementsToDelete);
			let formData = new FormData();
			formData.append(module, elementsToDeleteJSON);

			$.ajax({
				url: "controlador/Ajax.php", 
				method: "post", 
				data: formData, 
				cache: false, 
				contentType: false, 
				processData: false, 
				success: function (respuesta) {
					if (respuesta) {
						console.log(respuesta);
						window.location = 'index.php?pagina=' + view;
						alert('Eliminados correctamente');
					} else {
						window.location = 'index.php?pagina=' + view;
						alert('Registros no eliminados, intente más tarde o contacte al proveedor');
					}
				}
			});
		});

		$(btnCloseForm).click(function () {
			removeElementsChoosen();
		});
	}
}

function asMain(btnShowForm, checkElement, inputId, btnConfirmAsMain) {
	if (btnShowForm && checkElement && inputId && btnConfirmAsMain) {
		let recordId;
		let nameRequest;
		$(btnShowForm).click(function (){
			recordId = elementChecked(checkElement);
			inputId.val(recordId);
			if(btnShowForm.getAttribute('id') == 'btn-asmain-client-email') {
				nameRequest = 'client-asmain-email';
				console.log(nameRequest + ' - ' + recordId);
			} else if(btnShowForm.getAttribute('id') == 'btn-asmain-client-phone') {
				nameRequest = 'client-asmain-phone';
				console.log(nameRequest);
			} else if(btnShowForm.getAttribute('id') == 'btn-asmain-client-address') {
				nameRequest = 'client-asmain-address';
				console.log(nameRequest);
			}
		});

		$(btnConfirmAsMain).click(function (){
			console.log('Clic');
			let formData = new FormData();
			formData.append(nameRequest, recordId);

			$.ajax({
				url: 'controlador/Ajax.php', 
				method: 'post', 
				data: formData, 
				cache: false, 
				contentType: false, 
				processData: false, 
				dataType: 'json', 
				success: function (respuesta) {
					if (respuesta) {
						console.log(respuesta);
						let url = window.location.href;
						window.location = url
						alert('Se estableció como principal');
					} else {
						console.log("Sin respuesta");
						let url = window.location.href;
						window.location = url
						alert('No se pudo establecer como principal, intente más tarde');
					}
				}
			});
		})
	}
}

function fillSelectHTML (inputsData, nameFormData, callback) {
	if (NodeList.prototype.isPrototypeOf(inputsData)) {
		for (let i = 0; i < inputsData.length; i++) {
			$(inputsData[i]).click(function () {
				let data = inputsData[i].value;
				let formData = new FormData();
				formData.append(nameFormData, data);

				$.ajax({
					url: 'controlador/Ajax.php', 
					method: 'post', 
					data: formData, 
					cache: false, 
					contentType: false, 
					processData: false, 
					dataType: 'json', 
					success: function (response) {
						if (response) {
							callback(response);
						} else {
							callback('Sin respuesta');
						}
					}
				});
			});
		}
	} else {
	}
}

function autocompleteAddress (inputSearchAddress, inputEstado, inputMunicipio, inputColonia, inputCalle) {
	if (
		inputSearchAddress && 
		inputEstado && 
		inputMunicipio && 
		inputColonia && 
		inputCalle
	) {
		var autocomplete;
		autocomplete = new google.maps.places.Autocomplete(inputSearchAddress, {
			types: ['geocode'], 
			componentRestrictions: {
				country: "MX"
			}
		});
			
		google.maps.event.addListener(autocomplete, 'place_changed', function () {
			var data_place = autocomplete.getPlace();
			
			if (data_place.address_components[0].types) {
				console.log(data_place);
				console.log(data_place.address_components.length);
				for (let i = 0; i < data_place.address_components.length; i++) {
					if(
						data_place.address_components[i].types[0] === "administrative_area_level_1" && 
						inputEstado.value !== data_place.address_components[i].types[0].long_name
						){
						inputEstado.value = data_place.address_components[i].long_name;
						console.log("Estado: " + data_place.address_components[i].long_name);
					}else{
						console.log("No existe Estado");
					}
					if(
						data_place.address_components[i].types[0] === "locality" && 
						inputMunicipio.value !== data_place.address_components[i].types[0].long_name
						){
						inputMunicipio.value = data_place.address_components[i].long_name;
						console.log("Municipio: " + data_place.address_components[i].long_name);
					}else{
						console.log("No existe Municipio");
					}
					if(
						data_place.address_components[i].types[0] === "sublocality_level_1" && 
						inputColonia.value !== data_place.address_components[i].types[0].long_name
						){
						inputColonia.value = data_place.address_components[i].long_name;
						console.log("Colonia: " + data_place.address_components[i].long_name);
					}else{
						console.log("No existe colonia");
					}
					if(
						data_place.address_components[i].types[0] === "route" && 
						inputCalle.value !== data_place.address_components[i].types[0].long_name
						){
						inputCalle.value = data_place.address_components[i].long_name;
						console.log("Calle: " + data_place.address_components[i].long_name);
					}else{
						console.log("No existe Calle");
					}
				}
			}else{
				console.log("No se encontraron datos");
			}
		});
	}
}

fillSelectHTML(document.getElementsByName('pet-especie-new'), 'select-raza', function (resultado) {
	let select = document.getElementById('pet-raza-new');
	$('#pet-raza-new').empty();

	let optionDefault = document.createElement('option');
	optionDefault.setAttribute('value', '');
	optionDefault.innerHTML = 'Seleccione la raza';
	select.appendChild(optionDefault);
	

	for (let i = 0; i < resultado.length; i++) {
		let option = document.createElement('option');
		option.setAttribute('value', resultado[i]['idmascota_raza']);
		option.innerHTML = resultado[i]['raza'];
		select.appendChild(option);
	}
});

autocompleteAddress(
	document.getElementById('domicilio-ubicacion-new'), 
	document.getElementById('domicilio-estado-new'), 
	document.getElementById('domicilio-municipio-new'), 
	document.getElementById('domicilio-colonia-new'), 
	document.getElementById('domicilio-calle-new')
);

autocompleteAddress(
	document.getElementById('domicilio-ubicacion-edit'), 
	document.getElementById('domicilio-estado-edit'), 
	document.getElementById('domicilio-municipio-edit'), 
	document.getElementById('domicilio-colonia-edit'), 
	document.getElementById('domicilio-calle-edit')
);

editForm(BTN_EDIT_CLIENT_EMAIL, CHECK_CLIENT_EMAIL, $('#correo-id-edit'), function (resultado) {
	$('#correo-edit').val(resultado['correo']);
});

editForm(BTN_EDIT_USER_EMAIL, CHECK_USER_EMAIL, $('#correo-id-edit'), function (resultado) {
	$('#correo-edit').val(resultado['correo']);
});

editForm(BTN_EDIT_CLIENT, CHECK_CLIENT, $('#clienteId-edit'), function (resultado) {
	$('#cliente-edit').val(resultado['cliente']);
});

editForm(BTN_EDIT_USER, CHECK_USER, $('#usuarioId-edit'), function (resultado) {
	$('#tipo-usuario-edit').val(resultado['tipo']);
	$('#nombre-edit').val(resultado['nombre']);
});

editForm(BTN_EDIT_CLIENT_PHONE, CHECK_CLIENT_PHONE, $('#phone-id-edit'), function (resultado) {
	$('#telefono-edit').val(resultado['numero']);
	$('#tipotelefono-edit').val(resultado['tipo']);
});

editForm(BTN_EDIT_USER_PHONE, CHECK_USER_PHONE, $('#phone-id-edit'), function (resultado) {
	$('#telefono-edit').val(resultado['numero']);
	$('#tipotelefono-edit').val(resultado['tipo']);
});

editForm(BTN_EDIT_CLIENT_ADDRESS, CHECK_CLIENT_ADDRESS, $('#address-id-edit'), function (resultado) {
	let num_casaex = resultado['num_casaex'], num_casaint = resultado['num_casaint'];
	if (resultado['num_casaex'] == null || resultado['num_casaex'] == 0) {
		num_casaex = null;
	}
	if (resultado['num_casaint'] == null || resultado['num_casaint'] == 0) {
		num_casaint = null;
	}
	$('#domicilio-estado-edit').val(resultado['estado']);
	$('#domicilio-municipio-edit').val(resultado['localidad']);
	$('#domicilio-colonia-edit').val(resultado['colonia']);
	$('#domicilio-calle-edit').val(resultado['calle']);
	$('#domicilio-numero-e-edit').val(num_casaex);
	$('#domicilio-numero-i-edit').val(num_casaint);
	$('#domicilio-calle1-edit').val(resultado['calle1']);
	$('#domicilio-calle2-edit').val(resultado['calle2']);
	$('#domicilio-referencia-edit').val(resultado['referencia']);
});

editForm(BTN_EDIT_USER_ADDRESS, CHECK_USER_ADDRESS, $('#address-id-edit'), function (resultado) {
	let num_casaex = resultado['num_casaex'], num_casaint = resultado['num_casaint'];
	if (resultado['num_casaex'] == null || resultado['num_casaex'] == 0) {
		num_casaex = null;
	}
	if (resultado['num_casaint'] == null || resultado['num_casaint'] == 0) {
		num_casaint = null;
	}
	$('#domicilio-estado-edit').val(resultado['estado']);
	$('#domicilio-municipio-edit').val(resultado['localidad']);
	$('#domicilio-colonia-edit').val(resultado['colonia']);
	$('#domicilio-calle-edit').val(resultado['calle']);
	$('#domicilio-numero-e-edit').val(num_casaex);
	$('#domicilio-numero-i-edit').val(num_casaint);
	$('#domicilio-calle1-edit').val(resultado['calle1']);
	$('#domicilio-calle2-edit').val(resultado['calle2']);
	$('#domicilio-referencia-edit').val(resultado['referencia']);
});

editForm(BTN_ADD_CONSULT_PET, CHECK_PET, $('#pet-id-add-consult'), function (resultado) {
	$('#nombre-pet-consult-new').text('');
	$('#raza-pet-consult-new').text('');
	$('#sexo-pet-consult-new').text('');
	$('#edad-pet-consult-new').text('');
	$('#cc-pet-consult-new').text('');
	$('#tamano-pet-consult-new').text('');
	$('#peso-pet-consult-new').text('');
	$('#nombre-client-consult-new').text('');
	$('#tel-client-consult-new').text('');
	$('#email-client-consult-new').text('');
	$('#address-client-consult-new').text('');
	for(k in resultado) {
		if(resultado[k] == null) {
			resultado[k] = 'Sin datos';
		}
	}
	console.log(resultado);
	let edad = new Date().getFullYear() - resultado["ano_nacimiento"];
	let sexo = {'1':'Hembra', '2':'Macho'};
	let cc = {'1':'Delgado', '2':'Normal', '3':'Robusto'};
	let tamano = {'1':'Chico', '2':'Mediano', '3':'Grande'};
	let numcasa;
	let domicilio;
	if (resultado["num_casaint"] && resultado["calle"] && resultado["colonia"]) {
		resultado["num_casaint"] == 0 || resultado["num_casaint"] == undefined ? numcasa = 's/n' : numcasa = '#' + resultado["num_casaint"];
		domicilio = resultado["calle"] + ', ' + numcasa + ', ' + resultado["colonia"];
	} else {
		domicilio = 'Sin datos';
	}

	if (resultado["correo"] == undefined || resultado["numero"] == undefined || resultado["calle"] == undefined) {
		alert('No hay datos de contacto del dueño. Revisemos!');
		let urlClientId = window.location.search
		let clienteId = new URLSearchParams(urlClientId);
		window.location = 'index.php?pagina=Cliente&uc=' + clienteId.get('um');
	}
	$('#nombre-pet-consult-new').text(resultado["mascota"]);
	$('#raza-pet-consult-new').text(resultado["raza"]);
	$('#sexo-pet-consult-new').text(sexo[resultado["sexo"]]);
	$('#edad-pet-consult-new').text(edad + ' años');
	$('#cc-pet-consult-new').text(cc[resultado["condicion_corporal"]]);
	$('#tamano-pet-consult-new').text(tamano[resultado["tamano"]]);
	$('#peso-pet-consult-new').text(resultado["peso"] + ' Kg.');

	$('#nombre-client-consult-new').text(resultado["nombre"]);
	$('#tel-client-consult-new').text(resultado["numero"]);
	$('#email-client-consult-new').text(resultado["correo"]);
	$('#address-client-consult-new').text(domicilio);
});

deleteForm(BTN_DELETE_CLIENT, BTN_C_DELETE_CLIENT, BTN_CLOSE_FORM_DELETE_CLIENT, CHECK_CLIENT, FORM_DELETE_CLIENT, 'clientsToDelete', 'Clientes');

deleteForm(BTN_DELETE_USER, BTN_C_DELETE_USER, BTN_CLOSE_FORM_DELETE_USER, CHECK_USER, FORM_DELETE_USER, 'usersToDelete', 'Usuarios');

let urlClient = 'Cliente&uc=' + $('#clientId').val();
deleteForm(BTN_DELETE_CLIENT_EMAIL, BTN_C_DELETE_CLIENT_EMAIL, BTN_CLOSE_FORM_DELETE_CLIENT_EMAIL, CHECK_CLIENT_EMAIL, FORM_DELETE_CLIENT_EMAIL, 'emailsClientToDelete', urlClient);

deleteForm(BTN_DELETE_CLIENT_PHONE, BTN_C_DELETE_CLIENT_PHONE, BTN_CLOSE_FORM_DELETE_CLIENT_PHONE, CHECK_CLIENT_PHONE, FORM_DELETE_CLIENT_PHONE, 'phonesClientToDelete', urlClient);

deleteForm(BTN_DELETE_CLIENT_ADDRESS, BTN_C_DELETE_CLIENT_ADDRESS, BTN_CLOSE_FORM_DELETE_CLIENT_ADDRESS, CHECK_CLIENT_ADDRESS, FORM_DELETE_CLIENT_ADDRESS, 'addressClientToDelete', urlClient);

let urlUser = 'Usuario&uu=' + $('#userId').val();
deleteForm(BTN_DELETE_USER_EMAIL, BTN_C_DELETE_USER_EMAIL, BTN_CLOSE_FORM_DELETE_USER_EMAIL, CHECK_USER_EMAIL, FORM_DELETE_USER_EMAIL, 'emailsUserToDelete', urlUser);

deleteForm(BTN_DELETE_USER_PHONE, BTN_C_DELETE_USER_PHONE, BTN_CLOSE_FORM_DELETE_USER_PHONE, CHECK_USER_PHONE, FORM_DELETE_USER_PHONE, 'phonesUserToDelete', urlUser);

deleteForm(BTN_DELETE_USER_ADDRESS, BTN_C_DELETE_USER_ADDRESS, BTN_CLOSE_FORM_DELETE_USER_ADDRESS, CHECK_USER_ADDRESS, FORM_DELETE_USER_ADDRESS, 'addressUserToDelete', urlUser);

// A partir del nombre del botón clicado se nombrará la variable post que se envía al backend AJAX.
asMain(BTN_ASMAIN_CLIENT_EMAIL, CHECK_CLIENT_EMAIL, $('#client-asmain-element'), BTN_C_ASMAIN_CLIENT_ELEMENT);

asMain(BTN_ASMAIN_CLIENT_PHONE, CHECK_CLIENT_PHONE, $('#client-asmain-element'), BTN_C_ASMAIN_CLIENT_ELEMENT);

asMain(BTN_ASMAIN_CLIENT_ADDRESS, CHECK_CLIENT_ADDRESS, $('#client-asmain-element'), BTN_C_ASMAIN_CLIENT_ELEMENT);
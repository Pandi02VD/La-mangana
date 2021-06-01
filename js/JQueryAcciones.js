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

autocompleteAddress(
	document.getElementById('cliente-domicilio-ubicacion-new'), 
	document.getElementById('cliente-domicilio-estado-new'), 
	document.getElementById('cliente-domicilio-municipio-new'), 
	document.getElementById('cliente-domicilio-colonia-new'), 
	document.getElementById('cliente-domicilio-calle-new')
);

autocompleteAddress(
	document.getElementById('cliente-domicilio-ubicacion-edit'), 
	document.getElementById('cliente-domicilio-estado-edit'), 
	document.getElementById('cliente-domicilio-municipio-edit'), 
	document.getElementById('cliente-domicilio-colonia-edit'), 
	document.getElementById('cliente-domicilio-calle-edit')
);

editForm(BTN_EDIT_CLIENT_EMAIL, CHECK_CLIENT_EMAIL, $('#email-client-edit-id'), function (resultado) {
	$('#correo-cliente-edit').val(resultado['correo']);
});

editForm(BTN_EDIT_CLIENT, CHECK_CLIENT, $('#clienteId-edit'), function (resultado) {
	$('#cliente-edit').val(resultado['cliente']);
});

editForm(BTN_EDIT_USER, CHECK_USER, $('#usuarioId-edit'), function (resultado) {
	$('#tipo-usuario-edit').val(resultado['tipo']);
	$('#nombre-edit').val(resultado['nombre']);
});

editForm(BTN_EDIT_CLIENT_PHONE, CHECK_CLIENT_PHONE, $('#client-edit-phone-id'), function (resultado) {
	$('#cliente-telefono-edit').val(resultado['numero']);
	$('#cliente-tipotelefono-edit').val(resultado['tipo']);
});

editForm(BTN_EDIT_CLIENT_ADDRESS, CHECK_CLIENT_ADDRESS, $('#client-edit-address-id'), function (resultado) {
	console.log(resultado);
	let num_casaex = resultado['num_casaex'], num_casaint = resultado['num_casaint'];
	if (resultado['num_casaex'] == null || resultado['num_casaex'] == 0) {
		num_casaex = null;
	}
	if (resultado['num_casaint'] == null || resultado['num_casaint'] == 0) {
		num_casaint = null;
	}
	$('#cliente-domicilio-estado-edit').val(resultado['estado']);
	$('#cliente-domicilio-municipio-edit').val(resultado['localidad']);
	$('#cliente-domicilio-colonia-edit').val(resultado['colonia']);
	$('#cliente-domicilio-calle-edit').val(resultado['calle']);
	$('#cliente-domicilio-numero-e-edit').val(num_casaex);
	$('#cliente-domicilio-numero-i-edit').val(num_casaint);
	$('#cliente-domicilio-calle1-edit').val(resultado['calle1']);
	$('#cliente-domicilio-calle2-edit').val(resultado['calle2']);
	$('#cliente-domicilio-referencia-edit').val(resultado['referencia']);
});

deleteForm(BTN_DELETE_CLIENT, BTN_C_DELETE_CLIENT, BTN_CLOSE_FORM_DELETE_CLIENT, CHECK_CLIENT, FORM_DELETE_CLIENT, 'clientsToDelete', 'Clientes');

deleteForm(BTN_DELETE_USER, BTN_C_DELETE_USER, BTN_CLOSE_FORM_DELETE_USER, CHECK_USER, FORM_DELETE_USER, 'usersToDelete', 'Usuarios');

let urlClient = 'Cliente&uc=' + $('#clientId').val();
deleteForm(BTN_DELETE_CLIENT_EMAIL, BTN_C_DELETE_CLIENT_EMAIL, BTN_CLOSE_FORM_DELETE_CLIENT_EMAIL, CHECK_CLIENT_EMAIL, FORM_DELETE_CLIENT_EMAIL, 'emailsClientToDelete', urlClient);

deleteForm(BTN_DELETE_CLIENT_PHONE, BTN_C_DELETE_CLIENT_PHONE, BTN_CLOSE_FORM_DELETE_CLIENT_PHONE, CHECK_CLIENT_PHONE, FORM_DELETE_CLIENT_PHONE, 'phonesClientToDelete', urlClient);

deleteForm(BTN_DELETE_CLIENT_ADDRESS, BTN_C_DELETE_CLIENT_ADDRESS, BTN_CLOSE_FORM_DELETE_CLIENT_ADDRESS, CHECK_CLIENT_ADDRESS, FORM_DELETE_CLIENT_ADDRESS, 'addressClientToDelete', urlClient);
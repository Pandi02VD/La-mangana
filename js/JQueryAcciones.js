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

function editForm (btnShowFormEdit, checkElement, inputId, callback) {
	if (btnShowFormEdit) {
		$(btnShowFormEdit).click(function (){
			let recordId = elementChecked(checkElement);
			let nameRequest = inputId.attr('id');

			var formData = new FormData();
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
			dataType: "json", 
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

$(document).ready(function () {
	var autocomplete;
	autocomplete = new google.maps.places.Autocomplete(document.getElementById('cliente-domicilio-ubicacion-new'), {
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
					document.getElementById('cliente-domicilio-estado-new').value !== data_place.address_components[i].types[0].long_name
					){
					document.getElementById('cliente-domicilio-estado-new').value = data_place.address_components[i].long_name;
					console.log("Estado: " + data_place.address_components[i].long_name);
				}else{
					console.log("No existe Estado");
				}
				if(
					data_place.address_components[i].types[0] === "locality" && 
					document.getElementById('cliente-domicilio-municipio-new').value !== data_place.address_components[i].types[0].long_name
					){
					document.getElementById('cliente-domicilio-municipio-new').value = data_place.address_components[i].long_name;
					console.log("Municipio: " + data_place.address_components[i].long_name);
				}else{
					console.log("No existe Municipio");
				}
				if(
					data_place.address_components[i].types[0] === "sublocality_level_1" && 
					document.getElementById('cliente-domicilio-colonia-new').value !== data_place.address_components[i].types[0].long_name
					){
					document.getElementById('cliente-domicilio-colonia-new').value = data_place.address_components[i].long_name;
					console.log("Colonia: " + data_place.address_components[i].long_name);
				}else{
					console.log("No existe colonia");
				}
				if(
					data_place.address_components[i].types[0] === "route" && 
					document.getElementById('cliente-domicilio-calle-new').value !== data_place.address_components[i].types[0].long_name
					){
					document.getElementById('cliente-domicilio-calle-new').value = data_place.address_components[i].long_name;
					console.log("Calle: " + data_place.address_components[i].long_name);
				}else{
					console.log("No existe Calle");
				}
			}
		}else{
			console.log("No se encontraron datos");
		}
	});
});
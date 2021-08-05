<?php
	class Controlador{
		#Traer plantilla al index.
		public function plantilla(){
			include 'vista/Plantilla.php';
		}
		
		#Traer las vistas.
		public function traerPaginaCtl(){
			if (isset($_GET["pagina"])) {
				$pagina = $_GET["pagina"];
			}else{
				$pagina = "index";
			}
			$respuesta = Pagina::traerPagina($pagina);
			include $respuesta;
		}

		#Seleccionar correo electrónico del cliente o usuario para editar.
		public function seleccionarCorreoCtl($correoId){
			$respuesta = CRUD::seleccionarCorreoBD($correoId);
			return $respuesta;
		}
		
		#Seleccionar teléfono del cliente o usuario para editar.
		public function seleccionarTelefonoCtl($telefonoId){
			$respuesta = CRUD::seleccionarTelefonoBD($telefonoId);
			return $respuesta;
		}

		#Seleccionar domicili del cliente o usuario para editar.
		public function seleccionarDomicilioCtl($domicilioId){
			$respuesta = CRUD::seleccionarDomicilioBD($domicilioId);
			return $respuesta;
		}

		#Seleccionar todos los correos electrónicos del cliente o usuario.
		public function seleccionarCorreosCtl($clienteId){
			$respuesta = CRUD::seleccionarCorreosBD($clienteId);
			return $respuesta;
		}
		
		#Seleccionar todos los teléfonos del cliente o usuario.
		public function seleccionarTelefonosCtl($clienteId){
			$respuesta = CRUD::seleccionarTelefonosBD($clienteId);
			return $respuesta;
		}
		
		#Seleccionar todos los domicilios del cliente o usuario.
		public function seleccionarDomiciliosCtl($clienteId){
			$respuesta = CRUD::seleccionarDomiciliosBD($clienteId);
			return $respuesta;
		}
		
		#Agregar nuevo correo electrónico.
		public function nuevoCorreoCtl(){
			if (
				isset($_POST["correo-new"]) && 
				isset($_POST["add-email-id"])
			) {
				if (Validacion::correosElectronicos($_POST["correo-new"], 30)) {
					$datosCorreoCliente = array(
						"personaId" => $_POST["add-email-id"], 
						"correo" => $_POST["correo-new"]
					);
					$respuesta = CRUD::nuevoCorreoBD($datosCorreoCliente);
					if ($respuesta == true) {
						echo '<script>toast("Correo electrónico agregado correctamente!");</script>';
					} else {
						echo '<script>toast("Error al agregar el correo electrónico.");</script>';
					}
				} else {
					echo '<script>toast("No válido usa el formato nombre@ejemplo.com");</script>';
				}
			}
		}
		
		#Agregar nuevo teléfono.
		public function nuevoTelefonoCtl(){
			if (
				isset($_POST["telefono-new"]) && 
				isset($_POST["add-phone-id"]) && 
				isset($_POST["tipotelefono-new"])
			) {
				if (Validacion::enterosSinIntervalo($_POST["telefono-new"], 10)) {
					$datosTelefonoCliente = array(
						"personaId" => $_POST["add-phone-id"], 
						"telefono" => $_POST["telefono-new"], 
						"tipo" => $_POST["tipotelefono-new"]
					);
					$respuesta = CRUD::nuevoTelefonoBD($datosTelefonoCliente);
					if ($respuesta) {
						echo '<script>toast("Telefono agregado correctamente!");</script>';
					}else{
						echo '<script>toast("Error al agregar el teléfono.");</script>';
					}
				} else {
					echo '<script>toast("Debe contener solo 10 digitos númericos");</script>';
				}
			}
		}

		#Agregar nuevo domicilio.
		public function nuevoDomicilioCtl(){
			if (
				isset($_POST["domicilio-estado-new"]) && 
				isset($_POST["domicilio-municipio-new"]) && 
				isset($_POST["domicilio-colonia-new"]) && 
				isset($_POST["domicilio-calle-new"]) && 
				isset($_POST["domicilio-numero-e-new"]) && 
				isset($_POST["domicilio-numero-i-new"]) && 
				isset($_POST["domicilio-calle1-new"]) && 
				isset($_POST["domicilio-calle2-new"]) && 
				isset($_POST["domicilio-referencia-new"]) && 
				isset($_POST["add-address-id"])
			) {
				if (
					Validacion::nombresPropiosNumerados($_POST["domicilio-estado-new"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-municipio-new"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-colonia-new"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-calle-new"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-calle1-new"], 0, 25) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-calle2-new"], 0, 25) && 
					Validacion::enterosEnIntervalo($_POST["domicilio-numero-e-new"], 0, 5) && 
					Validacion::enterosEnIntervalo($_POST["domicilio-numero-i-new"], 0, 5) && 
					Validacion::descripciones($_POST["domicilio-referencia-new"], 2, 50)
				) {
					$datosDomicilioCliente = array(
						"personaId" => $_POST["add-address-id"], 
						"estado" => $_POST["domicilio-estado-new"], 
						"municipio" => $_POST["domicilio-municipio-new"], 
						"colonia" => $_POST["domicilio-colonia-new"], 
						"calle" => $_POST["domicilio-calle-new"], 
						"numeroE" => $_POST["domicilio-numero-e-new"], 
						"numeroI" => $_POST["domicilio-numero-i-new"], 
						"calle1" => $_POST["domicilio-calle1-new"], 
						"calle2" => $_POST["domicilio-calle2-new"], 
						"referencia" => $_POST["domicilio-referencia-new"], 
					);
					$respuesta = CRUD::nuevoDomicilioBD($datosDomicilioCliente);
					if ($respuesta) {
						echo '<script>toast("Domicilio agregado correctamente");</script>';
					}else{
						echo '<script>toast("Error al agregar el Domicilio");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}

		#Actualizar el correo electrónico.
		public function actualizarCorreoCtl($userId){
			if (isset($_POST["correo-edit"]) && isset($_POST["correo-id-edit"])) {
				if (Validacion::correosElectronicos($_POST["correo-edit"], 30)) {
					$datosCorreoCliente = array (
						"correoId" => $_POST["correo-id-edit"], 
						"correo" => $_POST["correo-edit"]
					);
	
					$respuesta = CRUD::actualizarCorreoBD($datosCorreoCliente);
					if ($respuesta) {
						echo '<script>toast("Correo electrónico actualizado");</script>';
					}else{
						echo '<script>toast("No se pudo actualizar el correo electrónico, revise sus datos");</script>';
					}
				} else {
					echo '<script>toast("No válido usa el formato nombre@ejemplo.com");</script>';
				}
			}
		}

		#Actualizar el teléfono.
		public function actualizarTelefonoCtl($userId){
			if (
				isset($_POST["telefono-edit"]) && 
				isset($_POST["tipotelefono-edit"]) && 
				isset($_POST["phone-id-edit"])
			) {
				if (Validacion::enterosSinIntervalo($_POST["telefono-edit"], 10)) {
					$datosTelefonoCliente = array (
						"telefonoId" => $_POST["phone-id-edit"], 
						"numero" => $_POST["telefono-edit"], 
						"tipo" => $_POST["tipotelefono-edit"]
					);
	
					$respuesta = CRUD::actualizarTelefonoBD($datosTelefonoCliente);
					if ($respuesta) {
						echo '<script>toast("Teléfono actualizado");</script>';
					}else{
						echo '<script>toast("no se pudo actualizar el teléfono, revise sus datos");</script>';
					}
				} else {
					echo '<script>toast("Debe contener solo 10 digitos númericos");</script>';
				}
			}
		}
		
		#Actualizar el domicilio.
		public function actualizarDomicilioCtl($userId){
			if (
				isset($_POST["domicilio-estado-edit"]) && 
				isset($_POST["domicilio-municipio-edit"]) && 
				isset($_POST["domicilio-colonia-edit"]) && 
				isset($_POST["domicilio-calle-edit"]) && 
				isset($_POST["domicilio-numero-e-edit"]) && 
				isset($_POST["domicilio-numero-i-edit"]) && 
				isset($_POST["domicilio-calle1-edit"]) && 
				isset($_POST["domicilio-calle2-edit"]) && 
				isset($_POST["domicilio-referencia-edit"]) && 
				isset($_POST["address-id-edit"])
			) {
				if (
					Validacion::nombresPropiosNumerados($_POST["domicilio-estado-edit"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-municipio-edit"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-colonia-edit"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-calle-edit"], 2, 50) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-calle1-edit"], 0, 25) && 
					Validacion::nombresPropiosNumerados($_POST["domicilio-calle2-edit"], 0, 25) && 
					Validacion::enterosEnIntervalo($_POST["domicilio-numero-e-edit"], 0, 5) && 
					Validacion::enterosEnIntervalo($_POST["domicilio-numero-i-edit"], 0, 5) && 
					Validacion::descripciones($_POST["domicilio-referencia-edit"], 2, 50)
				) {
					$datosDomicilioCliente = array(
						"domicilioId" => $_POST["address-id-edit"], 
						"estado" => $_POST["domicilio-estado-edit"], 
						"municipio" => $_POST["domicilio-municipio-edit"], 
						"colonia" => $_POST["domicilio-colonia-edit"], 
						"calle" => $_POST["domicilio-calle-edit"], 
						"numeroE" => $_POST["domicilio-numero-e-edit"], 
						"numeroI" => $_POST["domicilio-numero-i-edit"], 
						"calle1" => $_POST["domicilio-calle1-edit"], 
						"calle2" => $_POST["domicilio-calle2-edit"], 
						"referencia" => $_POST["domicilio-referencia-edit"], 
					);
	
					$respuesta = CRUD::actualizarDomicilioBD($datosDomicilioCliente);
					if ($respuesta) {
						echo '<script>toast("Domicilio actualizado");</script>';
					}else{
						echo '<script>toast("no se pudo actualizar el domicilio, revise sus datos");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}
		
		#Deshabilitar uno o más correos electrónicos de clientes o usuarios.
		public function eliminarCorreosCtl($correosEliminar){
			$respuestas = array();
			$conclusion = true;
			for ($i = 0; $i < sizeof($correosEliminar); $i++) {
				$respuesta = CRUD::eliminarCorreoBD($correosEliminar[$i]);
				if ($respuesta == false) {
					$respuestas[$i] = false;
				}
			}
			
			for ($i = 0; $i < sizeof($respuestas); $i++) {
				if ($respuestas[$i] == false) {
					$conclusion = false;
				}
			}
			return $conclusion;
		}
		
		#Deshabilitar uno o más teléfonos de clientes o usuarios.
		public function eliminarTelefonosCtl($telefonosEliminar){
			$respuestas = array();
			$conclusion = true;
			for ($i = 0; $i < sizeof($telefonosEliminar); $i++) {
				$respuesta = CRUD::eliminarTelefonoBD($telefonosEliminar[$i]);
				if ($respuesta == false) {
					$respuestas[$i] = false;
				}
			}
			
			for ($i = 0; $i < sizeof($respuestas); $i++) {
				if ($respuestas[$i] == false) {
					$conclusion = false;
				}
			}
			return $conclusion;
		}
		
		#Deshabilitar uno o más domicilios de clientes o usuarios.
		public function eliminarDomiciliosCtl($domiciliosEliminar){
			$respuestas = array();
			$conclusion = true;
			for ($i = 0; $i < sizeof($domiciliosEliminar); $i++) {
				$respuesta = CRUD::eliminarDomicilioBD($domiciliosEliminar[$i]);
				if ($respuesta == false) {
					$respuestas[$i] = false;
				}
			}
			
			for ($i = 0; $i < sizeof($respuestas); $i++) {
				if ($respuestas[$i] == false) {
					$conclusion = false;
				}
			}
			return $conclusion;
		}

		#Establecer información de contacto de cliente o ususario como principal.
		public function asMainElementCtl($elementId, $tabla) {
			$respuesta = CRUD::asMainElementBD($elementId, $tabla);
			return $respuesta;
		}
	}
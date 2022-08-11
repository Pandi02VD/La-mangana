<?php 
	require_once '../modelo/CRUD.php';
	require_once '../modelo/CRUDAgenda.php';
	require_once '../modelo/CRUDExterno.php';
	require_once '../modelo/CRUDUsuario.php';
	require_once 'Controlador.php';
	require_once 'ControladorAgenda.php';
	require_once 'ControladorUsuario.php';
	require_once 'ControladorExterno.php';

	class Ajax{
		public $cancelarCitas;
		public $datosCita;
		public $datosUsuario;
		public $config;
		public $buscar;

		#Obtener la configuración.
		public function getConfigAjax() {
			$dato = $this -> config;
			$respuesta = ControladorUsuario::selConfigHoraCtl($dato);
			echo json_encode($respuesta);
		}

		#Recuperar fecha de cita para editar o posponer.
		public function fechaCitaAjax(){
			$dato = $this -> datosCita;
			$respuesta = ControladorAgenda::fechaCitaCtl($dato);
			echo json_encode($respuesta);
		}
		
		#Recuperar datos de usuario para editarlos.
		public function datosUsuarioAjax(){
			$dato = $this -> datosUsuario;
			$respuesta = ControladorUsuario::datosUsuarioCtl($dato);
			echo json_encode($respuesta);
		}
		
		#Cancelar una o más citas.
		public function cancelarCitasAjax(){
			$datos = $this -> cancelarCitas;
			$respuesta = ControladorAgenda::cancelarCitasCtl($datos);
			echo $respuesta;
		}
		
		#Deshabilitar uno o más usuarios.
		public function eliminarUsuariosAjax(){
			$datos = $this -> datosUsuario;
			$respuesta = ControladorUsuario::eliminarUsuariosCtl($datos);
			echo json_encode($respuesta);
		}

		#Seleccionar correo electrónico para editar.
		public function selCorreoAjax(){
			$datos = $this -> datosUsuario;
			$respuesta = Controlador::selCorreoCtl($datos);
			echo json_encode($respuesta);
		}
		
		#Seleccionar teléfono para editar.
		public function selTelefonoAjax(){
			$datos = $this -> datosUsuario;
			$respuesta = Controlador::selTelefonoCtl($datos);
			echo json_encode($respuesta);
		}
		
		#Seleccionar domicilio del cliente para editar.
		public function selDomicilioAjax(){
			$datos = $this -> datosUsuario;
			$respuesta = Controlador::selDomicilioCtl($datos);
			echo json_encode($respuesta);
		}

		#Seleccionar datos de cita de paciente nuevo.
		public function selCitaAjax(){
			$idCita = $this -> datosCita;
			$respuesta = ControladorExterno::selCitaCtl($idCita);
			echo json_encode($respuesta);
		}
		
		// #Seleccionar los atributos de la mascota.
		// public function seleccionarAtributosAjax(){
		// 	$mascotaId = $this -> grafica;
		// 	$respuesta = ControladorMascota::seleccionarAtributosCtl($mascotaId);
		// 	echo json_encode($respuesta);
		// }
		
		// #Seleccionar las razas de la especie obtenida.
		// public function seleccionarRazasByEspecieAjax(){
		// 	$requestCD = $this -> selectRaza;
		// 	$respuesta = ControladorMascota::seleccionarRazasByEspecieCtl($requestCD);
		// 	echo json_encode($respuesta);
		// }
		
		// #Establecer correo electrónico como principal.
		// public function asMainElementAjax($tabla){
		// 	$elementId = $this -> asMain;
		// 	$respuesta = Controlador::asMainElementCtl($elementId, $tabla);
		// 	echo json_encode($respuesta);
		// }
		
		// #Obtener la información de una mascota para mostrarla en el registro de consulta.
		// public function datosMascotaAjax(){
		// 	$mascotaId = $this -> datosMascota;
		// 	$respuesta = ControladorMascota::datosMascotaCtl($mascotaId);
		// 	echo json_encode($respuesta);
		// }
		
		#Buscar citas.
		public function buscarCitasAjax(){
			$buscar = $this -> buscar;
			$respuesta = ControladorAgenda::buscarCitasCtl($buscar);
			echo json_encode($respuesta);
		}
		
		#Buscar usuario.
		public function buscarUsuariosAjax(){
			$buscar = $this -> buscar;
			$respuesta = ControladorUsuario::buscarUsuariosCtl($buscar);
			echo json_encode($respuesta);
		}
	}
	
	if (isset($_POST["config"])) {
		$objConfig = new Ajax();
		$objConfig -> config = json_decode($_POST["config"]);
		$objConfig -> getConfigAjax();
	}
	
	if (isset($_POST["cancelarCitas"])) {
		$objIdEliminar = new Ajax();
		$objIdEliminar -> cancelarCitas = json_decode($_POST["cancelarCitas"]);
		$objIdEliminar -> cancelarCitasAjax();
	}
	
	if (isset($_POST["eliminarUsuarios"])) {
		$objIdEliminar = new Ajax();
		$objIdEliminar -> datosUsuario = json_decode($_POST["eliminarUsuarios"]);
		$objIdEliminar -> eliminarUsuariosAjax();
	}
	
	if (isset($_POST["nuevo-paciente"])) {
		$objDatosCita = new Ajax();
		$objDatosCita -> datosCita = json_decode($_POST["nuevo-paciente"]);
		$objDatosCita -> selCitaAjax();
	}
	
	if (isset($_POST["correoABtn-s"])) {
		$objUserDataEdit = new Ajax();
		$objUserDataEdit -> datosUsuario = $_POST["correoABtn-s"];
		$objUserDataEdit -> selCorreoAjax();
	}
	
	if (isset($_POST["telefonoABtn-s"])) {
		$objUserDataEdit = new Ajax();
		$objUserDataEdit -> datosUsuario = $_POST["telefonoABtn-s"];
		$objUserDataEdit -> selTelefonoAjax();
	}
	
	if (isset($_POST["domicilioABtn-s"])) {
		$objUserDataEdit = new Ajax();
		$objUserDataEdit -> datosUsuario = $_POST["domicilioABtn-s"];
		$objUserDataEdit -> selDomicilioAjax();
	}
	
	if (isset($_POST["correoEBtn-s"])) {
		$objUserDataEdit = new Ajax();
		$objUserDataEdit -> datosUsuario = $_POST["correoEBtn-s"];
		$objUserDataEdit -> selCorreoAjax();
	}
	
	if (isset($_POST["telefonoEBtn-s"])) {
		$objUserDataEdit = new Ajax();
		$objUserDataEdit -> datosUsuario = $_POST["telefonoEBtn-s"];
		$objUserDataEdit -> selTelefonoAjax();
	}
	
	if (isset($_POST["domicilioEBtn-s"])) {
		$objUserDataEdit = new Ajax();
		$objUserDataEdit -> datosUsuario = $_POST["domicilioEBtn-s"];
		$objUserDataEdit -> selDomicilioAjax();
	}
	
	// if (isset($_POST["clienteId-edit"])) {
	// 	$objRequestClientEdit = new Ajax();
	// 	$objRequestClientEdit -> requestClientEdit = $_POST["clienteId-edit"];
	// 	$objRequestClientEdit -> datosClienteAjax();
	// }
	
	if (isset($_POST["idPosponer"])) {
		$objdatosCita = new Ajax();
		$objdatosCita -> datosCita = $_POST["idPosponer"];
		$objdatosCita -> fechaCitaAjax();
	}
	
	if (isset($_POST["idUsuario-A"])) {
		$objdatosUsuario = new Ajax();
		$objdatosUsuario -> datosUsuario = $_POST["idUsuario-A"];
		$objdatosUsuario -> datosUsuarioAjax();
	}

	// if (isset($_POST["petId-edit"])) {
	// 	$petEdit = new Ajax();
	// 	$petEdit -> requestPetDataEdit = $_POST["petId-edit"];
	// 	$petEdit -> selMascotaAjax();
	// }
	
	// if (isset($_POST["jaulaId-edit"])) {
	// 	$objJaulaEdit = new Ajax();
	// 	$objJaulaEdit -> requestPetDataEdit = $_POST["jaulaId-edit"];
	// 	$objJaulaEdit -> selJaulaAjax();
	// }
	
	// if (isset($_POST["razaId-edit"])) {
	// 	$objRazaEdit = new Ajax();
	// 	$objRazaEdit -> requestPetDataEdit = $_POST["razaId-edit"];
	// 	$objRazaEdit -> selDatosRazaAjax();
	// }
	
	// if (isset($_POST["graficaMascota"])) {
	// 	$objGrafica = new Ajax();
	// 	$objGrafica -> grafica = $_POST["graficaMascota"];
	// 	$objGrafica -> selAtributosAjax();
	// }
	
	// if (isset($_POST["select-raza"])) {
	// 	$objSelectRaza = new Ajax();
	// 	$objSelectRaza -> selectRaza = $_POST["select-raza"];
	// 	$objSelectRaza -> selRazasByEspecieAjax();
	// }
	
	// if (isset($_POST["asmain-email"])) {
	// 	$objAsMain = new Ajax();
	// 	$objAsMain -> asMain = $_POST["asmain-email"];
	// 	$objAsMain -> asMainElementAjax("user_correo");
	// }
	
	// if (isset($_POST["asmain-phone"])) {
	// 	$objAsMain = new Ajax();
	// 	$objAsMain -> asMain = $_POST["asmain-phone"];
	// 	$objAsMain -> asMainElementAjax("user_telefono");
	// }
	
	// if (isset($_POST["asmain-address"])) {
	// 	$objAsMain = new Ajax();
	// 	$objAsMain -> asMain = $_POST["asmain-address"];
	// 	$objAsMain -> asMainElementAjax("user_domicilio");
	// }
	
	// if (isset($_POST["pet-id-add-consult"])) {
	// 	$objInfoPet = new Ajax();
	// 	$objInfoPet -> datosMascota = $_POST["pet-id-add-consult"];
	// 	$objInfoPet -> datosMascotaAjax();
	// }
	
	if (isset($_POST["buscarCitas"])) {
		$objbuscar = new Ajax();
		$objbuscar -> buscar = $_POST["buscarCitas"];
		$objbuscar -> buscarCitasAjax();
	}
	
	if (isset($_POST["buscarUsuarios"])) {
		$objbuscar = new Ajax();
		$objbuscar -> buscar = $_POST["buscarUsuarios"];
		$objbuscar -> buscarUsuariosAjax();
	}
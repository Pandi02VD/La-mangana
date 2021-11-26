<?php
	class ControladorMascota{
		#Buscar mascota.
		public function buscarMascotaCtl($search) {
			if(is_array($search)) {
				$txtSearch = $search[0];
				$clienteId = $search[1];
				$respuesta = CRUDMascota::buscarMascotaClienteBD($txtSearch, $clienteId);
			} else {
				$respuesta = CRUDMascota::buscarMascotaBD($search);
			}
			return $respuesta;
		}
		
		#Buscar raza.
		public function buscarRazaCtl($search) {
			$respuesta = CRUDMascota::buscarRazaBD($search);
			return $respuesta;
		}
		
		#Buscar jaula.
		public function buscarJaulaCtl($search) {
			$respuesta = CRUDMascota::buscarJaulaBD($search);
			return $respuesta;
		}

		#Agregar nueva mascota de cliente.
		public function nuevaMascotaCtl(){
			if (
				isset($_POST["pet-nombre-new"]) && 
				isset($_POST["pet-property-new"]) && 
				isset($_POST["pet-especie-new"]) && 
				isset($_POST["pet-raza-new"]) && 
				isset($_POST["pet-sexo-new"]) && 
				isset($_POST["pet-edad-new"]) && 
				isset($_POST["pet-peso-new"]) && 
				isset($_POST["pet-tamano-new"]) && 
				isset($_POST["pet-cuerpo-new"])
			) {
				if (
					Validacion::nombresPropios($_POST["pet-nombre-new"], 2, 50) && 
					Validacion::enterosSinIntervalo($_POST["pet-edad-new"], 4) && 
					Validacion::decimales($_POST["pet-peso-new"], 6)
				) {
					$datosMascota = array(
						"nombre" => $_POST["pet-nombre-new"], 
						"propietarioId" => $_POST["pet-property-new"], 
						"raza" => $_POST["pet-raza-new"], 
						"sexo" => $_POST["pet-sexo-new"], 
						"edad" => $_POST["pet-edad-new"]
					);
	
					$mascotaRegistrada = CRUDMascota::nuevaMascotaBD($datosMascota);
					$idmascota;
					if($mascotaRegistrada != null) { 
						$idmascota = $mascotaRegistrada["id"];
						$atributos = array(
							"mascotaId" => $idmascota, 
							"peso" => $_POST["pet-peso-new"], 
							"tamano" => $_POST["pet-tamano-new"], 
							"cuerpo" => $_POST["pet-cuerpo-new"]
						);
						$atributosMascota = CRUDMascota::nuevosAtributosBD($atributos);
						if ($atributosMascota) {
							echo '<script>toast("Mascota agregada correctamente");</script>';
						} else {
							echo '<script>toast("Mascota no agregada");</script>';
						}
					} else {
						echo '<script>toast("Mascota no agregada");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}
		
		#Actualizar la información de una mascota de cliente.
		public function actualizarMascotaCtl(){
			if (
				isset($_POST["petId-edit"]) && 
				isset($_POST["pet-nombre-edit"]) && 
				isset($_POST["pet-property-edit"]) && 
				isset($_POST["pet-especie-edit"]) && 
				isset($_POST["pet-raza-edit"]) && 
				isset($_POST["pet-sexo-edit"]) && 
				isset($_POST["pet-edad-edit"])
			) {
				if (
					Validacion::nombresPropios($_POST["pet-nombre-edit"], 2, 50) && 
					Validacion::enterosSinIntervalo($_POST["pet-edad-edit"], 4)
				) {
					$datosMascota = array(
						"mascotaId" => $_POST["petId-edit"], 
						"nombre" => $_POST["pet-nombre-edit"], 
						"propietarioId" => $_POST["pet-property-edit"], 
						"raza" => $_POST["pet-raza-edit"], 
						"sexo" => $_POST["pet-sexo-edit"], 
						"edad" => $_POST["pet-edad-edit"]
					);
					$mascotaActualizada = CRUDMascota::actualizarMascotaBD($datosMascota);
					if($mascotaActualizada != false) { 
							echo '<script>toast("Mascota actualizada correctamente");</script>';
					} else {
						echo '<script>toast("Mascota no actualizada");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}

		#Recuperar datos de una mascota de la base de datos.
		public function datosMascotaCtl($mascotaId) {
			$respuesta = CRUDMascota::datosMascotaBD($mascotaId);
			return $respuesta;
		}

		#Seleccionar atributos de mascota para la gráfica.
		public function seleccionarAtributosCtl($mascotaId){
			$respuesta = CRUDMascota::seleccionarAtributosBD($mascotaId);
			return $respuesta;
		}
		
		#Seleccionar todas las mascotas.
		public function seleccionarMascotasCtl(){
			$respuesta = CRUDMascota::seleccionarMascotasBD();
			return $respuesta;
		}
		
		#Seleccionar una mascota.
		public function seleccionarMascotaCtl($mascotaId){
			$respuesta = CRUDMascota::datosMascotaBD($mascotaId);
			return $respuesta;
		}
		
		#Recuperar la información de una mascota para editar.
		public function infoMascotaCtl($mascotaId){
			$respuesta = CRUDMascota::infoMascota($mascotaId);
			return $respuesta;
		}

		#Seleccionar las especies.
		public function seleccionarEspeciesCtl(){
			$respuesta = CRUDMascota::seleccionarEspeciesBD();
			return $respuesta;
		}

		#Seleccionar datos de raza para editar.
		public function seleccionarDatosRazaCtl($razaId) {
			$respuesta = CRUDMascota::seleccionarDatosRazaBD($razaId);
			return $respuesta;
		}

		#Agregar raza.
		public function nuevaRazaCtl(){
			if (isset($_POST["raza-especie-new"]) && isset($_POST["raza-nombre-new"])) {
				if (Validacion::nombresPropios($_POST["raza-nombre-new"], 2, 30)) {
					$datosRaza = array(
						'especieId' => $_POST["raza-especie-new"], 
						'raza' => $_POST["raza-nombre-new"]
					);
					$nuevaRaza = CRUDMascota::nuevaRazaBD($datosRaza);
					if ($nuevaRaza) {
						echo '<script>toast("Raza agregada correctamente");</script>';
					} else {
						echo '<script>toast("Raza no agregada");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}
		
		#Actualizar informacion de una raza.
		public function actualizarRazaCtl() {
			if (
				isset($_POST["razaId-edit"]) && 
				isset($_POST["raza-especie-edit"]) && 
				isset($_POST["raza-nombre-edit"])
			) {
				if (Validacion::nombresPropios($_POST["raza-nombre-edit"], 2, 30)) {
					$datosRaza = array(
						'razaId' => $_POST["razaId-edit"], 
						'especieId' => $_POST["raza-especie-edit"], 
						'raza' => $_POST["raza-nombre-edit"]
					);
					$actualizarRaza = CRUDMascota::actualizarRazaBD($datosRaza);
					if ($actualizarRaza) {
						echo '<script>toast("Raza actualizada correctamente");</script>';
					} else {
						echo '<script>toast("Raza no actualizada");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}

		#Deshabilitar una o más razas.
		public function eliminarRazasCtl($razasEliminar){
			$respuestas = array();
			$conclusion = true;
			for ($i = 0; $i < sizeof($razasEliminar); $i++) {
				$respuesta = CRUDMascota::eliminarRazasBD($razasEliminar[$i]);
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

		#Seleccionar especie por raza.
		public function seleccionarEspecieByRazaCtl($especieId){
			$respuesta = CRUDMascota::seleccionarEspecieByRazaBD($especieId);
			return $respuesta;
		}
		
		#Seleccionar todas las razas.
		public function seleccionarRazasCtl(){
			$respuesta = CRUDMascota::seleccionarRazasBD();
			return $respuesta;
		}
		
		#Seleccionar las razas por especie.
		public function seleccionarRazasByEspecieCtl($especieId){
			$respuesta = CRUDMascota::seleccionarRazasByEspecieBD($especieId);
			return $respuesta;
		}

		#Seleccionar las mascotas del cliente.
		public function mascotasClienteCtl($clienteId){
			$respuesta = CRUDMascota::mascotasClienteBD($clienteId);
			return $respuesta;
		}

		#Seleccionar raza de mascota 
		public function seleccionarRazaMascotaCtl($razaId){
			$respuesta = CRUDMascota::seleccionarRazaMascotaBD($razaId);
			return $respuesta;
		}

		#Seleccionar jaula de mascota.
		public function seleccionarJaulaCtl($jaulaId) {
			$respuesta = CRUDMascota::seleccionarJaulaBD($jaulaId);
			return $respuesta;
		}
		
		#Seleccionar jaulas de mascotas.
		public function seleccionarJaulasCtl() {
			$respuesta = CRUDMascota::seleccionarJaulasBD();
			return $respuesta;
		}

		#Agregar jaula.
		public function nuevaJaulaCtl(){
			if (isset($_POST["jaula-num-new"])) {
				if (Validacion::enterosEnIntervalo($_POST["jaula-num-new"], 1, 2)) {
					$jaula = $_POST["jaula-num-new"];
					$existeJaula = CRUDMascota::existeJaulaBD($jaula);
					if($existeJaula == null) { 
						$nuevaJaula = CRUDMascota::nuevaJaulaBD($jaula);
						if ($nuevaJaula) {
							echo '<script>toast("Jaula agregada correctamente");</script>';
						} else {
							echo '<script>toast("Jaula no agregada");</script>';
						}
					} else {
						echo '<script>toast("Ya existe esta jaula, coloque otro número");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}

		#Actualizar informacion de una jaula.
		public function actualizarJaulaCtl() {
			if (isset($_POST["jaula-num-edit"]) && isset($_POST["jaulaId-edit"])) {
				if (Validacion::enterosEnIntervalo($_POST["jaula-num-edit"], 1, 2)) {
					$datosJaula = array(
						'jaulaId' => $_POST["jaulaId-edit"], 
						'jaula' => $_POST["jaula-num-edit"]
					);
					$existeJaula = CRUDMascota::existeJaulaBD($datosJaula["jaula"]);
					if($existeJaula == null) { 
						$actualizarJaula = CRUDMascota::actualizarJaulaBD($datosJaula);
						if ($actualizarJaula) {
							echo '<script>toast("Jaula actualizada correctamente");</script>';
						} else {
							echo '<script>toast("Jaula no actualizada");</script>';
						}
					} else {
						echo '<script>toast("Ya existe esta jaula, coloque otro número");</script>';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
			}
		}
		
		// #Ocupar informacion de una jaula.
		// public function ocuparJaulaCtl($jaulaId) {
		// 	$respuesta = CRUDMascota::ocuparJaulaBD($jaulaId);
		// 	return $respuesta;
		// }

		#Deshabilitar una o más jaulas.
		public function eliminarJaulasCtl($jaulasEliminar){
			$respuestas = array();
			$conclusion = true;
			for ($i = 0; $i < sizeof($jaulasEliminar); $i++) {
				$respuesta = CRUDMascota::eliminarJaulasBD($jaulasEliminar[$i]);
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
		
		#Deshabilitar una o más mascotas.
		public function eliminarMascotasCtl($mascotasEliminar){
			$respuestas = array();
			$conclusion = true;
			for ($i = 0; $i < sizeof($mascotasEliminar); $i++) {
				$respuesta = CRUDMascota::eliminarMascotasBD($mascotasEliminar[$i]);
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
	}
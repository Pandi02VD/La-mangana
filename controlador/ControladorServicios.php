<?php
	class ControladorServicios {
		#Registro de nueva consulta
		public function nuevaConsultaCtl() {
			if (
				isset($_POST["pet-id-add-consult"]) && 
				isset($_POST["medico-consult-new"]) && 
				isset($_POST["momento-consult-new"]) && 
				isset($_POST["peso-pet-consult-new"]) && 
				isset($_POST["tamano-pet-consult-new"]) && 
				isset($_POST["cc-pet-consult-new"]) && 
				isset($_POST["observaciones-consult-new"]) && 
				(
					isset($_POST["service-H-consult-new"]) || 
					isset($_POST["service-C-consult-new"]) || 
					isset($_POST["service-M-consult-new"])
				) && 
				isset($_POST["costo-consult-new"])
			) {
				$datosConsulta = array(
					'mascota' => $_POST["pet-id-add-consult"], 
					'medico' => $_POST["medico-consult-new"], 
					'momento' => $_POST["momento-consult-new"], 
					'pesoPet' => $_POST["peso-pet-consult-new"], 
					'tamanoPet' => $_POST["tamano-pet-consult-new"], 
					'ccPet' => $_POST["cc-pet-consult-new"], 
					'observaciones' => $_POST["observaciones-consult-new"], 
					'costo' => $_POST["costo-consult-new"]
				);
				$primerServicioURL;
				$servicios = array();

				if (isset($_POST["service-H-consult-new"])) {
					$datosConsulta['serviceH'] = $_POST["service-H-consult-new"];
					$primerServicioURL = "Hospitalizacion";
					$servicios["hospital"] = "1";
				}

				if (isset($_POST["service-C-consult-new"])) {
					$datosConsulta['serviceC'] = $_POST["service-C-consult-new"];
					$servicios["cirugia"] = "1";
				}
				
				if (isset($_POST["service-M-consult-new"])) {
					$datosConsulta['serviceM'] = $_POST["service-M-consult-new"];
					$primerServicioURL = "Medicina";
					$servicios["medicina"] = "1";
				}
				$serviciosJSON = json_encode($servicios);
				isset($_POST["tags"]) ? $tags = $_POST["tags"] : $tags = null;
				$nuevaConsulta = CRUDServicios::nuevaConsultaBD($datosConsulta, $tags, $serviciosJSON);
				if ($nuevaConsulta == false) {
					echo '
						<script>window.location = "index.php?pagina=Servicios&error=true"</script>
					';
				} else {
					echo '
						<script>window.location = "index.php?pagina=' . 
						$primerServicioURL.'&us='.$nuevaConsulta["id"].'";</script>
					';
				}
			}
		}

		#Validar servicio.
		public function validarServicioCtl($servicioId, $servicioNombre) {
			$respuesta = CRUDServicios::validarServicioBD($servicioId);
			if (isset($respuesta->$servicioNombre)) {
				return $respuesta->$servicioNombre;
			} else {
				echo '<script>window.location = "index.php?pagina=Servicios&error=true"</script>';
			}
		}

		#Obtener consulta.
		public function obtenerConsultaCtl($servicioId) {
			$respuesta = CRUDServicios::obtenerConsultaBD($servicioId);
			return $respuesta;
		}

		#Seleccionar todos los servicios.
		public function seleccionarServiciosCtl() {
			$servicios = CRUDServicios::seleccionarServiciosBD();
			return $servicios;
		}

		#Obtener etiqueta <a></a> del servicio Hospitalización.
		public function hospitalAElementCtl($JSONServicios, $consultaId) {
			if (isset($JSONServicios->hospital)) {
				$status = ['init', 'progress', 'finish'];
				$atributos = array('status' => '', 'on' => '', 'href' => '#');
				$hospitalId = CRUDServicios::hospitalIdByConsultBD($consultaId);
				if($hospitalId["hospitalId"] != null) {
					$atributos["href"] = "index.php?pagina=HospitalizacionInfo&us=".$hospitalId["hospitalId"];
					$atributos["status"] = $status[$hospitalId["status"] - 1];
				} else {
					$atributos["href"] = "index.php?pagina=Hospitalizacion&us=".$consultaId;
					$atributos["status"] = 'warn';
				}
				return $atributos;
			} else {
				return array('status' => '', 'on' => 'disabled', 'href' => '#');
			}
		}
		
		#Obtener etiqueta <a></a> del servicio Cirugía.
		public function cirugiaAElementCtl($JSONServicios, $consultaId) {
			if (isset($JSONServicios->cirugia)) {
				$status = ['init', 'progress', 'finish'];
				$atributos = array('status' => '', 'on' => '', 'href' => '#');
				$cirugiaId = CRUDServicios::cirugiaIdByConsultBD($consultaId);
				if($cirugiaId["cirugiaId"] != null) {
					$atributos["href"] = "index.php?pagina=CirugiaInfo&us=".$cirugiaId["cirugiaId"];
					$atributos["status"] = $status[$cirugiaId["status"] - 1];
				} else {
					$atributos["href"] = "index.php?pagina=Cirugia&us=".$consultaId;
					$atributos["status"] = 'warn';
				}
				return $atributos;
			} else {
				return array('status' => '', 'on' => 'disabled', 'href' => '#');
			}
		}
		
		#Obtener etiqueta <a></a> del servicio Medicina.
		public function medicinaAElementCtl($JSONServicios, $consultaId) {
			if (isset($JSONServicios->medicina)) {
				$status = ['init', 'progress', 'finish'];
				$atributos = array('status' => '', 'on' => '', 'href' => '#');
				$medicinaId = CRUDServicios::medicinaIdByConsultBD($consultaId);
				if($medicinaId["medicinaId"] != null) {
					$atributos["href"] = "index.php?pagina=MedicinaInfo&us=".$medicinaId["medicinaId"];
					$atributos["status"] = $status[$medicinaId["status"] - 1];
				} else {
					$atributos["href"] = "index.php?pagina=Medicina&us=".$consultaId;
					$atributos["status"] = 'warn';
				}
				return $atributos;
			} else {
				return array('status' => '', 'on' => 'disabled', 'href' => '#');
			}
		}

		#Nueva Hospitalización.
		public function nuevaHospitalizacionCtl() {
			if (
				isset($_POST["next-service-new"]) && 
				isset($_POST["consultaId-new"]) && 
				isset($_POST["entrada-H-new"]) && 
				isset($_POST["jaula-H-new"]) && 
				isset($_POST["motivo-H-new"]) && 
				isset($_POST["costo-H-new"])
			) {
				$jaula = CRUDMascota::existeJaulaBD($_POST["jaula-H-new"]);
				if ($jaula == null) {
					echo '<script>toast("No existe la jaula seleccionada");</script>';
				} else if ($jaula["status"] != 1) {
					echo '<script>toast("La jaula seleccionada no está disponible");</script>';
				}

				$datosHospital = array(
					'consultaId' => $_POST["consultaId-new"], 
					'next' => $_POST["next-service-new"], 
					'entrada' => $_POST["entrada-H-new"], 
					'jaula' => $_POST["jaula-H-new"], 
					'motivo' => $_POST["motivo-H-new"], 
					'costo' => $_POST["costo-H-new"]
				);
				isset($_POST["obs-H-new"]) ? $datosHospital["obs"] = $_POST["obs-H-new"] : null;
				

				// $nuevaHospitalizacion = CRUDServicios::nuevaHospitalizacionBD($datosHospital);
				// if ($nuevaHospitalizacion != null) {
					echo '
						<script>window.location = "index.php?'.
						$datosHospital["next"].'&us='.$datosHospital["consultaId"].'"</script>
					';
				// }
			}
		}
	}
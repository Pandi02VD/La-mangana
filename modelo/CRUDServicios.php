<?php
	class CRUDServicios {
		#Nueva consulta de mascota en la base de datos.
		public function nuevaConsultaBD($datosConsulta, $tags, $serviciosJSON) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO 
				consulta (idmascota, idmedico, observaciones, acs_mascota, servicios, costo, momento, status) 
				VALUE (:idmascota, :idmedico, :observaciones, :acs_mascota, :servicios, :costo, :momento, 1);"
			);
			$tags != null ? $JSONtags = CRUDServicios::JSONItems($tags) : $JSONtags = null;

			$sql -> bindParam(":idmascota", $datosConsulta["mascotaId"], PDO::PARAM_INT);
			$sql -> bindParam(":idmedico", $datosConsulta["medico"], PDO::PARAM_INT);
			$sql -> bindParam(":observaciones", $datosConsulta["observaciones"], PDO::PARAM_STR);
			$sql -> bindParam(":acs_mascota", $JSONtags);
			$sql -> bindParam(":servicios", $serviciosJSON);
			$sql -> bindParam(":costo", $datosConsulta["costo"]);
			$sql -> bindParam(":momento", $datosConsulta["momento"]);

			if ($sql -> execute()) {
				$ultimaConsulta = CRUDMascota::lastIdFrom("consulta", "idconsulta");
				return $ultimaConsulta;
			} else {
				return false;
			}

			$sql -> close();
			$sql = null;
		}

		#Generar el JSON de un array de mascota.
		public function JSONItems($items) {
			$arrayAccesorios = array();
			for ($i = 0; $i < sizeof($items); $i++) { 
				$arrayAccesorios['item'.$i] = $items[$i];
			}
			return json_encode($arrayAccesorios);
		}

		#Validar servicio.
		public function validarServicioBD($servicioId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT servicios FROM consulta WHERE idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $servicioId, PDO::PARAM_INT);
			$sql -> execute();
			return json_decode($sql -> fetch()["servicios"]);
			$sql -> close();
			$sql = null;
		}
		
		#Obtener consulta.
		public function personasConsultaBD($servicioId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.nombre AS medico, m.nombre AS mascota, c.servicios 
				FROM consulta c 
				INNER JOIN user u ON u.iduser = c.idmedico 
				INNER JOIN mascota m ON m.idmascota = c.idmascota 
				WHERE idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $servicioId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Seleccionar todos los servicios.
		public function seleccionarServiciosBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					c.idconsulta AS consulta, 
					-- u.nombre AS cliente, 
					m.nombre AS mascota, 
					med.nombre AS medico, 
					c.observaciones AS motivo, 
					c.servicios, 
					c.costo, 
					date_format(c.momento, '%d-%b-%Y') AS fecha
				FROM consulta c 
				-- INNER JOIN user u ON u.iduser = c.iduser
				INNER JOIN user med ON med.iduser = c.idmedico
				INNER JOIN mascota m ON m.idmascota = c.idmascota
				WHERE c.status = 1;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql -> close();
			$sql = null;
		}

		#Seleccionar id de Hospitalización de consulta.
		public function hospitalIdByConsultBD($consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					h.idhospitalizacion AS hospitalId, 
					h.status AS status 
				FROM consulta c 
				INNER JOIN hospitalizacion h ON h.idconsulta = c.idconsulta
				WHERE h.status = 1 AND h.idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar id de Cirugía de consulta.
		public function cirugiaIdByConsultBD($consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					ci.idcirujia AS cirugiaId, 
					ci.status AS status 
				FROM consulta c 
				INNER JOIN cirujia ci ON ci.idconsulta = c.idconsulta
				WHERE ci.status = 1 AND ci.idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar id de Medicina de consulta.
		public function medicinaIdByConsultBD($consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					m.idmedicina AS medicinaId, 
					m.status AS status 
				FROM consulta c 
				INNER JOIN medicina m ON m.idconsulta = c.idconsulta
				WHERE m.status = 1 AND m.idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Nueva Hospitalización.
		public function nuevaHospitalizacionBD($datosHospital) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO 
					hospitalizacion (
						idconsulta, idjaula, motivo, observaciones, entrada, salida, costo, status
					) 
					VALUE (
						:idconsulta, :idjaula, :motivo, :observaciones, :entrada, null, :costo, 1
					);"
			);
			$sql -> bindParam(":idconsulta", $datosHospital["consultaId"], PDO::PARAM_INT);
			$sql -> bindParam(":idjaula", $datosHospital["jaula"], PDO::PARAM_INT);
			$sql -> bindParam(":motivo", $datosHospital["motivo"], PDO::PARAM_STR);
			$sql -> bindParam(":observaciones", $datosHospital["obs"]);
			$sql -> bindParam(":entrada", $datosHospital["entrada"]);
			$sql -> bindParam(":costo", $datosHospital["costo"]);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Nueva Cirugía.
		public function nuevaCirugiaBD($datosCirugia) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO 
					cirujia (
						idconsulta, tipo_cirujia, entrada, salida, costo, observaciones, documento, status
					) 
					VALUE (
						:idconsulta, :tipo_cirujia, :entrada, null, :costo, :observaciones, null, 1
					);"
			);
			$sql -> bindParam(":idconsulta", $datosCirugia["consultaId"], PDO::PARAM_INT);
			$sql -> bindParam(":tipo_cirujia", $datosCirugia["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":entrada", $datosCirugia["entrada"]);
			$sql -> bindParam(":costo", $datosCirugia["costo"]);
			$sql -> bindParam(":observaciones", $datosCirugia["obs"]);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Nueva Receta Médica.
		public function nuevaMedicacionBD($consultaId, $medical) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO 
					medicina (
						idconsulta, diagnostico, medicacion, status
					) 
					VALUE (
						:idconsulta, null, :medicacion, 1
					);"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> bindParam(":medicacion", $medical);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		#Validar si un servicio está pendiente por llenar.
		public function servicioPendienteBD($tabla, $consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT status FROM $tabla WHERE idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
	}
<?php
	class CRUDServicios {
		#Nueva consulta de mascota en la base de datos.
		public function nuevaConsultaBD($datosConsulta, $tags, $serviciosJSON) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO 
				consulta (idmascota, idmedico, observaciones, acs_mascota, servicios, costo, momento, status) 
				VALUE (:idmascota, :idmedico, :observaciones, :acs_mascota, :servicios, :costo, :momento, 1);"
			);
			$tags != null ? $JSONtags = CRUDServicios::JSONAccesorios($tags) : $JSONtags = null;

			$sql -> bindParam(":idmascota", $datosConsulta["mascota"], PDO::PARAM_INT);
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

		#Generar el JSON de accesorios de mascota.
		public function JSONAccesorios($tags) {
			$arrayAccesorios = array();
			$arrayTags = $tags;
			for ($i=0; $i < sizeof($arrayTags); $i++) { 
				$arrayAccesorios["acs".$i] = $arrayTags[$i];
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
		public function obtenerConsultaBD($servicioId) {
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
	}
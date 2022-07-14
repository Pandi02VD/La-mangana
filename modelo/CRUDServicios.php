<?php
	class CRUDServicios {
		#Nueva consulta de mascota en la base de datos.
		static public function nuevaConsultaBD($datosConsulta, $tags, $serviciosJSON) {
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

			$sql = null;
		}

		#Generar el JSON de un array de mascota.
		static public function JSONItems($items) {
			$arrayAccesorios = array();
			for ($i = 0; $i < sizeof($items); $i++) { 
				$arrayAccesorios['item'.$i] = $items[$i];
			}
			return json_encode($arrayAccesorios);
		}

		#Validar servicio.
		static public function validarServicioBD($servicioId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT servicios FROM consulta WHERE idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $servicioId, PDO::PARAM_INT);
			$sql -> execute();
			return json_decode($sql -> fetch()["servicios"]);
			$sql = null;
		}
		
		#Obtener consulta.
		static public function personasConsultaBD($servicioId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT c.idmascota, u.nombre AS medico, m.nombre AS mascota, c.servicios 
				FROM consulta c 
				INNER JOIN user u ON u.iduser = c.idmedico 
				INNER JOIN mascota m ON m.idmascota = c.idmascota 
				WHERE idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $servicioId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar todos los servicios.
		static public function seleccionarServiciosBD() {
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
				WHERE c.status = 1 ORDER BY c.momento DESC;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Seleccionar los servicios de una mascota.
		static public function seleccionarServiciosMascotaBD($mascotaId) {
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
				WHERE c.status = 1 AND c.idmascota = :idmascota
				ORDER BY c.momento DESC LIMIT 3;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Seleccionar la Historia Clínica de una mascota.
		static public function seleccionarHistoriaClinicaBD($mascotaId) {
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
				WHERE c.status = 1 AND c.idmascota = :idmascota
				ORDER BY c.momento DESC LIMIT 3;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Seleccionar id de Hospitalización de consulta.
		static public function hospitalIdByConsultBD($consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					h.idhospitalizacion AS hospitalId, 
					h.status AS status, 
					j.jaula AS jaula
				FROM hospitalizacion h 
				INNER JOIN jaula j ON h.idjaula = j.idjaula
				WHERE h.status >= 1 AND h.idconsulta = :idconsulta;"
			);
			# No se porque lo hice así...
			// $sql = Conexion::conectar() -> prepare(
			// 	"SELECT 
			// 		h.idhospitalizacion AS hospitalId, 
			// 		h.status AS status 
			// 	FROM consulta c 
			// 	INNER JOIN hospitalizacion h ON h.idconsulta = c.idconsulta
			// 	WHERE h.status = 1 AND h.idconsulta = :idconsulta;"
			// );
			# No se porque lo hice así...

			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar id de Cirugía de consulta.
		static public function cirugiaIdByConsultBD($consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					ci.idcirujia AS cirugiaId, 
					ci.status AS status 
				FROM consulta c 
				INNER JOIN cirujia ci ON ci.idconsulta = c.idconsulta
				WHERE ci.status >= 1 AND ci.idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar id de Medicina de consulta.
		static public function medicinaIdByConsultBD($consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					m.idmedicina AS medicinaId, 
					m.status AS status 
				FROM consulta c 
				INNER JOIN medicina m ON m.idconsulta = c.idconsulta
				WHERE m.status >= 1 AND m.idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Nueva Hospitalización.
		static public function nuevaHospitalizacionBD($datosHospital) {
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
			$sql = null;
		}
		
		#Nueva Cirugía.
		static public function nuevaCirugiaBD($datosCirugia) {
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
			$sql = null;
		}
		
		#Nueva Receta Médica.
		static public function nuevaMedicacionBD($consultaId, $medical) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO 
					medicina (
						idconsulta, diagnostico, medicacion, fecha, status
					) 
					VALUE (
						:idconsulta, null, :medicacion, now(), 1
					);"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> bindParam(":medicacion", $medical);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Validar si un servicio está pendiente por llenar.
		static public function servicioPendienteBD($tabla, $consultaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT status FROM $tabla WHERE idconsulta = :idconsulta;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar la información de Medicación desde la base de datos.
		static public function medicinaInfoBD($servicioId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT medicacion 
				FROM medicina WHERE idmedicina = :idmedicina;"
			);
			$sql -> bindParam(":idmedicina", $servicioId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Seleccionar la información de la receta desde la base de datos.
		static public function recetaInfoBD($servicioId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				date_format(m.fecha, '%d/%b/%Y') AS fecha, 
				me.nombre AS medico, c.idmascota 
				FROM medicina m 
				INNER JOIN consulta c ON c.idconsulta = m.idconsulta
				INNER JOIN user me ON me.iduser = c.idmedico
				WHERE idmedicina = :idmedicina;"
			);
			$sql -> bindParam(":idmedicina", $servicioId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar la información de la mascota en la receta desde la base de datos.
		static public function mascotaInfoBD($mascotaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				m.nombre AS mascota, 
				m.sexo, m.ano_nacimiento, ma.raza, me.especie 
				FROM mascota m 
				INNER JOIN mascota_raza ma ON ma.idmascota_raza = m.idmascota_raza 
				INNER JOIN mascota_especie me ON me.idmascota_especie = ma.idmascota_especie 
				WHERE idmascota = :idmascota;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar la información del propietario en la receta desde la base de datos.
		static public function propInfoBD($mascotaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				p.nombre AS prop
				FROM mascota m 
				INNER JOIN user p ON p.iduser = m.iduser
				WHERE idmascota = :idmascota;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar la información de la consulta desde la base de datos.
		static public function obtenerConsultaBD($consultaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT observaciones, costo, date_format(momento, '%d/%b/%Y a las %h:%m %p hrs.') AS fecha 
				FROM consulta 
				WHERE idconsulta = :idconsulta AND status = 1;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar la información de Hospitalización desde la base de datos.
		static public function obtenerHospitalizacionBD($hospitalId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT *, date_format(entrada, '%d/%b/%Y a las %h:%m %p') AS entrada 
				FROM hospitalizacion 
				WHERE idhospitalizacion = :idhospital;"
			);
			$sql -> bindParam(":idhospital", $hospitalId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar la información de la Cirugía desde la base de datos.
		static public function obtenerCirugiaBD($cirugiaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT *, date_format(entrada, '%d/%b/%Y a las %h:%m %p') AS entrada 
				FROM cirujia 
				WHERE idcirujia = :idcirujia;"
			);
			$sql -> bindParam(":idcirujia", $cirugiaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Buscar servicio en la base de datos.
		static public function buscarServicioBD($search) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					c.idconsulta AS consulta, 
					m.nombre AS mascota, 
					med.nombre AS medico, 
					c.observaciones AS motivo, 
					c.servicios, 
					c.costo, 
					date_format(c.momento, '%d-%b-%Y') AS fecha
				FROM consulta c 
				INNER JOIN user med ON med.iduser = c.idmedico
				INNER JOIN mascota m ON m.idmascota = c.idmascota
				WHERE CONCAT_WS('', m.nombre LIKE '%$search%' OR med.nombre LIKE '%$search%' OR 
				c.observaciones LIKE '%$search%') AND c.status = 1 ORDER BY c.momento DESC;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Dar alta de Cirujía en la base de datos.
		static public function altaCirujiaBD($datosCirugia) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE cirujia 
				SET salida = :salida, status = 3 
				WHERE idcirujia = :idcirujia AND status >= 1;"
			);
			$sql -> bindParam(":salida", $datosCirugia["tiempo"]);
			$sql -> bindParam(":idcirujia", $datosCirugia["idCirujia"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}
		
		#Dar alta de Hospitalización en la base de datos.
		static public function altaHospitalBD($datosHospital) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE hospitalizacion 
				SET salida = :salida, status = 3 
				WHERE idhospitalizacion = :idhospital AND status >= 1;"
			);
			$sql -> bindParam(":salida", $datosHospital["tiempo"]);
			$sql -> bindParam(":idhospital", $datosHospital["idHospital"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}
	}
<?php
	class CRUDServicios {
		// #Obtener el último registro de la tabla consulta.
		// public function ultimaConsultaBD() {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT max(idconsulta) AS idconsulta 
		// 		FROM consutla;"
		// 	);
		// 	$sql -> execute();
		// 	return $sql -> fetch();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		#Nueva consulta de mascota en la base de datos.
		public function nuevaConsultaBD($datosConsulta, $tags) {
			// $sql = Conexion::conectar() -> prepare(
			// 	"INSERT INTO 
			// 	consulta (idmascota, idmedico, observaciones, acs_mascota, costo, momento, status) 
			// 	VALUE (:idmascota, :idmedico, :observaciones, :acs_mascota, :costo, :momento, 1);"
			// );
			// $JSONtags = CRUDServicios::JSONAccesorios($tags);

			// $sql -> bindParam(":idmascota", $datosConsulta["mascota"], PDO::PARAM_INT);
			// $sql -> bindParam(":idmedico", $datosConsulta["medico"], PDO::PARAM_INT);
			// $sql -> bindParam(":observaciones", $datosConsulta["observaciones"], PDO::PARAM_STR);
			// $sql -> bindParam(":acs_mascota", $JSONtags);
			// $sql -> bindParam(":costo", $datosConsulta["costo"]);
			// $sql -> bindParam(":momento", $datosConsulta["momento"]);

			// if ($sql -> execute()) {
				$ultimaConsulta = CRUDMascota::lastIdFrom("consulta", "idconsulta");
				return $ultimaConsulta;
			// } else {
				// return false;
			// }

			// $sql -> close();
			// $sql = null;
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
	}
<?php
	require_once 'Conexion.php'; 
	class CRUDExterno	{
		#Agendar cita de paciente nuevo 
		/**
		 * Cuando el paciente genera la cita por sí mismo 
		 * desde la página web.
		 */
		static public function agendarCitaBD($datosCita) {
			$sql = Conexion::conectar() -> prepare (
				"INSERT INTO 
				cita (
					nombre, apellidos, telefono, fechaCita, fechaRegistro, estado
				)
				VALUE (
					:nombre, :apellidos, :telefono, :fechaCita, now(), 1
				)"
			);
			$tiempo = $datosCita["fecha"]." ".$datosCita["hora"];
			$sql -> bindParam(':nombre', $datosCita["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(':apellidos', $datosCita["apellidos"], PDO::PARAM_STR);
			$sql -> bindParam(':telefono', $datosCita["telefono"], PDO::PARAM_STR);
			$sql -> bindParam(':fechaCita', $tiempo);
			if ($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		#Seleccionar los datos de cita de paciente nuevo para agregarlo al sistema.
		static public function selCitaBD($idCita) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM cita WHERE idCita = :idCita;"
			);
			$sql -> bindParam(":idCita", $idCita, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Deshabilitar cita.
		static public function quitarCitaBD($idCita) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE cita SET estado = 2 WHERE idCita = :idCita;"
			);
			$sql -> bindParam(":idCita", $idCita, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}
	}
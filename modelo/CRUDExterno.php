<?php
	require_once 'Conexion.php'; 
	class CRUDExterno	{
		#Agendar cita de paciente nuevo 
		/**
		 * Cuando el paciente genera la cita por sí mismo 
		 * desde la página web.
		 */
		public function agendarCitaBD($datosCita) {
			$sql = Conexion::conectar() -> prepare (
				"INSERT INTO 
				cita (
					nombre, apellidos, telefono, fechaCita, fechaRegistro, estado
				)
				VALUE (
					:nombre, :apellidos, :telefono, :fechaCita, now(), 1
				)"
			);
			$sql -> bindParam(':nombre', $datosCita["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(':apellidos', $datosCita["apellidos"], PDO::PARAM_STR);
			$sql -> bindParam(':telefono', $datosCita["telefono"], PDO::PARAM_STR);
			$sql -> bindParam(':fechaCita', $datosCita["tiempo"]);
			if ($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}
	}
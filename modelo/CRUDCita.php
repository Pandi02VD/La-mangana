<?php
	require_once 'Conexion.php';
	class CRUDCita {
		#Vista de las citas existentes.
		public function selCitasBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT *, date_format(fechaCita, '%d-%b-%Y %H:%i hrs') fechaCita FROM cita WHERE estado = 1;"
			);
			$sql -> execute();
			return $sql -> fetchALL();
			$sql -> close();
			$sql = null;
		}
	}
	
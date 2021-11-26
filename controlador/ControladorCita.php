<?php
	class ControladorCita {
		#Vista de las citas existentes.
		public function selCitasCtl() {
			$citas = CRUDCita::selCitasBD();
			return $citas;
		}
	}
	
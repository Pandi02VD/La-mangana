<?php
	class ControladorExterno {
		#Agendar cita de paciente nuevo 
		/**
		 * Cuando el paciente genera la cita por sí mismo 
		 * desde la página web.
		 */
		public function agendarCitaCtl() {
			if (
				isset($_POST["citaNombre-n"]) &&
				isset($_POST["citaApellidos-n"]) &&
				isset($_POST["citaTelefono-n"]) &&
				isset($_POST["citaTiempo-n"])
			) {
				if (
					Validacion::nombresPropios($_POST["citaNombre-n"], 2, 30) &&
					Validacion::nombresPropios($_POST["citaApellidos-n"], 2, 50) &&
					Validacion::enterosSinIntervalo($_POST["citaTelefono-n"], 10)
				) {
					$datosCita = array(
						'nombre' => ($_POST["citaNombre-n"]), 
						'apellidos' => ($_POST["citaApellidos-n"]), 
						'telefono' => ($_POST["citaTelefono-n"]), 
						'tiempo' => ($_POST["citaTiempo-n"])
					);
					$nuevaCita = CRUDExterno::agendarCitaBD($datosCita);
					if ($nuevaCita == true) {
						echo '<script>toast("Cita agendada para " + "'.$datosCita["tiempo"].'");</script>';
					} else {
						echo '<script>toast("Cita no agendada, revise su información.");</script>';
					}
				} else {
					echo '<script>toast("Hay campos vacíos o incorrectos.");</script>';
				}
			}
		}
	}
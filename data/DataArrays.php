<?php
	class DataArrays {
		#Obtener los tipos de teléfonos.
		static public function getTipoTel() {
			return array(
				'1' => 'Móvil', 
				'2' => 'Casa', 
				'3' => 'Trabajo'
			);
		}
		
		#Obtener los cargos de usuario.
		static public function getCargos() {
			return array(
				'2' => 'Gerente', 
				'3' => 'Doctor', 
				'4' => 'Recepcionista', 
				'5' => 'Asistente'
			);
		}
		
		#Obtener todos los posibles cargos de usuario.
		static public function getAllCargos() {
			return array(
				'0' => 'Paciente', 
				'1' => 'Administrador', 
				'2' => 'Gerente', 
				'3' => 'Doctor', 
				'4' => 'Recepcionista', 
				'5' => 'Asistente'
			);
		}
		
		#Obtener la fecha actual.
		static public function getFecha() {
			setlocale(LC_TIME, "spanish");
			$fecha = date("d-m-Y H:i");
			return $fecha;
		}
		
		#Obtener pacientes nuevos.
		static public function getCounterCitas($citas) {
			$citasAtrasadas = 0;
			$citasActuales = 0;
			$citasHoy = 0;
			$fechaA = strtotime(DataArrays::getFecha());
			foreach ($citas as $k => $v) : 
				$fechaCita = strtotime($v["fechaCiF"]);
				if ($fechaCita == $fechaA) {
					$citasActuales++;
					$citasHoy++;
				} elseif ($fechaCita > $fechaA) {
					$citasActuales++;
				} elseif ($fechaCita < $fechaA) {
					$citasAtrasadas++;
				}
			endforeach;
			$counterCitas = array(
				'atrasadas' => $citasAtrasadas, 
				'hoy' => $citasHoy, 
				'actuales' => $citasActuales
			);
			return $counterCitas;
		}

		#Obtener la fecha configurada.
		static public function getFechaConfig($fechaJSON) {
			$horaA = $fechaJSON->horaA;
			$horaC = $fechaJSON->horaC;
			unset($fechaJSON->horaA);
			unset($fechaJSON->horaC);
			$a = ""; $inicio = ""; $fin = "";
			$dias = DataArrays::getDiasSemana();
			$corte = 0;
			foreach($fechaJSON as $k => $v) {
				if(!$v) {
					$corte++;
				}
				if ($v && $corte <= 1) {
					if (!$inicio) {
						$inicio = $k;
					} else {
						$fin = $k;
						$a = "De " . $dias[$inicio] . " a " . $dias[$fin];
					}
				} else {
					$a .= $dias[$k]." ";
				}
			}
			$horario = $a . " de ". $horaA . " a " . $horaC . " hrs.";
			return $horario;
		}

		#Obtener el array de días de la semana.
		static public function getDiasSemana() {
			return array(
				'd1' => 'Lunes', 
				'd2' => 'Martes', 
				'd3' => 'Miércoles', 
				'd4' => 'Jueves', 
				'd5' => 'Viernes', 
				'd6' => 'Sábado', 
				'd7' => 'Domingo'
			);
		}
	}
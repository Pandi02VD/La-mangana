<?php
	class MainInfo {
		static public function obtenerCorreoPrincipal($correos) {
			$correoPrincipal = 'No se ha asignado';
			if($correos == null) {
				return 'No hay registros';
			} else {
				foreach ($correos as $key => $value) {
					if ($value["status"] == 2) {
						$correoPrincipal = $value["correo"];
					} 
				}
				return $correoPrincipal;
			}
		}
		
		static public function obtenerTelefonoPrincipal($telefonos) {
			$telefonoPrincipal = 'No se ha asignado';
			if($telefonos == null) {
				return 'No hay registros';
			} else {
				foreach ($telefonos as $key => $value) {
					if ($value["status"] == 2) {
						$telefonoPrincipal = $value["numero"];
					}
				}
				return $telefonoPrincipal;
			}
		}
		
		static public function obtenerDomicilioPrincipal($domicilios) {
			$domicilioPrincipal = 'No se ha asignado';
			$numcasaext = 's/n';
			if($domicilios == null) {
				return 'No hay registros';
			} else {
				foreach ($domicilios as $key => $value) {
					if ($value["status"] == 2) {
						$value["num_casaex"] != null ? $numcasaext = '#'.$value["num_casaex"] : $value["num_casaex"];
						$domicilioPrincipal = $value["calle"] . ', ' . $numcasaext . ', ' . $value["colonia"];
					} 
				}
				return $domicilioPrincipal;
			}
		}
	}
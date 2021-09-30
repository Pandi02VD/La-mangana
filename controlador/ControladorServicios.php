<?php
	class ControladorServicios {
		#Registro de nueva consulta
		public function nuevaConsultaCtl() {
			if (
				isset($_POST["pet-id-add-consult"]) && 
				isset($_POST["medico-consult-new"]) && 
				isset($_POST["momento-consult-new"]) && 
				isset($_POST["peso-pet-consult-new"]) && 
				isset($_POST["tamano-pet-consult-new"]) && 
				isset($_POST["cc-pet-consult-new"]) && 
				isset($_POST["observaciones-consult-new"]) && 
				(
					isset($_POST["service-H-consult-new"]) || 
					isset($_POST["service-C-consult-new"]) || 
					isset($_POST["service-M-consult-new"])
				) && 
				isset($_POST["tags"]) && 
				isset($_POST["costo-consult-new"])
			) {
				$datosConsulta = array(
					'mascota' => $_POST["pet-id-add-consult"], 
					'medico' => $_POST["medico-consult-new"], 
					'momento' => $_POST["momento-consult-new"], 
					'pesoPet' => $_POST["peso-pet-consult-new"], 
					'tamanoPet' => $_POST["tamano-pet-consult-new"], 
					'ccPet' => $_POST["cc-pet-consult-new"], 
					'observaciones' => $_POST["observaciones-consult-new"], 
					'costo' => $_POST["costo-consult-new"]
				);
				$serviciosURL;

				if (isset($_POST["service-H-consult-new"])) {
					$datosConsulta['serviceH'] = $_POST["service-H-consult-new"];
					$serviciosURL .= "&hospital=".$datosConsulta['serviceH'];
				}

				if (isset($_POST["service-C-consult-new"])) {
					$datosConsulta['serviceC'] = $_POST["service-C-consult-new"];
					$serviciosURL .= "&surgery=".$datosConsulta['serviceC'];
				}
				
				if (isset($_POST["service-M-consult-new"])) {
					$datosConsulta['serviceM'] = $_POST["service-M-consult-new"];
					$serviciosURL .= "&medical=".$datosConsulta['serviceM'];
				}
				$tags = $_POST["tags"];
				$nuevaConsulta = CRUDServicios::nuevaConsultaBD($datosConsulta, $tags);
				if ($nuevaConsulta == false) {
					echo '
						<script>window.location = "index.php?pagina=Servicios"</script>
					';
				} else {
					echo '
						<script>window.location = "index.php?pagina=Servicios' . 
						'&us='.$nuevaConsulta["id"] . 
						$serviciosURL . '"</script>
					';
				}
				// $JSONAccesorios = CRUDServicios::JSONAccesorios($tags);
				// echo '<script>alert("'.
					// 	$datosConsulta["momento"] . '\n' . 
					// 	$datosConsulta["medico"] . '\n' . 
					// 	$datosConsulta["pesoPet"] . '\n' . 
					// 	$datosConsulta["tamanoPet"] . '\n' . 
					// 	$datosConsulta["ccPet"] . '\n' . 
					// 	$datosConsulta["serviceH"] . '\n' . 
					// $JSONAccesorios
				// .'");</script>';
			}
		}
	}
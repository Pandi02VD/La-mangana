<?php
	class ControladorPaciente{
		// #Buscar Pacientes.
		// static public function buscarPacientesCtl($buscar) {
		// 	$respuesta = CRUDPaciente::buscarPacientesBD($buscar);
		// 	return $respuesta;
		// }

		#Seleccionar los Pacientes 
		static public function selPacientesCtl(){
			$respuesta = CRUDPaciente::selPacientesBD();
			return $respuesta;
		}
		
		#Seleccionar la información inicial del Paciente 
		static public function selInfoPacienteCtl($idPaciente){
			$respuesta = CRUDPaciente::selInfoPacienteBD($idPaciente);
			return $respuesta;
		}

		#Seleccionar los atributos del Paciente 
		static public function selAtributosCtl($idPaciente){
			$respuesta = CRUDPaciente::selAtributosBD($idPaciente);
			// if (!$respuesta) {
			// 	$respuesta = array(
			// 		'idPacienteAtributos' => null, 
			// 		'idUsuario' => null, 
			// 		'sexo' => null, 
			// 		'estadoCivil' => null, 
			// 		'fechaNacimiento' => null, 
			// 		'ocupacion' => null, 
			// 		'estado' => null
			// 	);
			// }
			return $respuesta;
		}
		
		#Contar los Pacientes 
		static public function contarPacientesCtl(){
			$respuesta = CRUDPaciente::contarPacientesBD();
			return $respuesta;
		}

		// // #Seleccionar estado de conexión de los Pacientes activos.
		// // static public function seleccionarConexionPacientesCtl(){
		// // 	$respuesta = CRUDPaciente::seleccionarConexionPacientesBD();
		// // 	return $respuesta;
		// // }

		// #Recuperar datos de Paciente.
		// static public function datosPacienteCtl($idPaciente){
		// 	$respuesta = CRUDPaciente::datosPacienteBD($idPaciente);
		// 	return $respuesta;
		// }

		// // #Seleccionar todos los Pacientes de tipo médico.
		// // static public function medicosCtl() {
		// // 	$respuesta = CRUDPaciente::medicosBD();
		// // 	return $respuesta;
		// // }

		// #Actualizar datos de Paciente.
		// static public function actualizarPacienteCtl(){
		// 	if (
		// 		isset($_POST["idPaciente-A"]) && 
		// 		isset($_POST["PacienteNombre-A"]) && 
		// 		isset($_POST["PacienteApellidos-A"]) && 
		// 		isset($_POST["PacienteCargo-A"])
		// 		) {
		// 		if (
		// 			Validacion::nombresPropios($_POST["PacienteNombre-A"], 2, 30) && 
		// 			Validacion::nombresPropios($_POST["PacienteApellidos-A"], 2, 50)
		// 		) {
		// 			$datosPaciente = array(
		// 				"idPaciente" => $_POST["idPaciente-A"], 
		// 				"nombre" => $_POST["PacienteNombre-A"], 
		// 				"apellidos" => $_POST["PacienteApellidos-A"], 
		// 				"cargo" => $_POST["PacienteCargo-A"]
		// 			);
		// 			$respuesta = CRUDPaciente::actualizarPacienteBD($datosPaciente);
		// 			if($respuesta) {
		// 				echo '<script>toast("Datos actualizados");</script>
		// 				';
		// 			}else{
		// 				echo '<script>toast("Error al actualizar");</script>
		// 				';
		// 			}
		// 		} else {
		// 			echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
		// 		}
				
		// 	}
		// }

		// // #Actualizar contraseña de Paciente.
		// // static public function actualizarPicCtl(){
		// // 	if (
		// // 		isset($_POST["PacienteId"]) && 
		// // 		isset($_POST["contrasena-old"]) && 
		// // 		isset($_POST["contrasena-edit"])
		// // 		) {
		// // 		if (Validacion::contrasenas($_POST["contrasena-edit"], 30)) {
		// // 			$picOld = Pic::progPic($_POST["contrasena-old"]);
		// // 			$picNew = Pic::progPic($_POST["contrasena-edit"]);
		// // 			$datosPic = array(
		// // 				"PacienteId" => $_POST["PacienteId"], 
		// // 				"contrasenaOld" => $picOld, 
		// // 				"contrasenaNew" => $picNew
		// // 			);
		// // 			$PicOld = CRUDPaciente::verificarPicOldBD($datosPic);
		// // 			if ($PicOld == null) {
		// // 				echo '<script>toast("La contraseña anterior no es válida");</script>';
		// // 			} else {
		// // 				$respuesta =CRUDPaciente::actualizarPicBD($datosPic);
		// // 				if($respuesta) {
		// // 					echo '
		// // 						<script>
		// // 							window.location = "index.php?pagina=Pacientes";
		// // 							alert("Datos actualizados");
		// // 						</script>
		// // 					';
		// // 				}else{
		// // 					echo '
		// // 						<script>
		// // 							alert("Error al actualizar");
		// // 							window.location = "index.php?pagina=Pacientes";
		// // 						</script>
		// // 					';
		// // 				}   
		// // 			}
		// // 		} else {
		// // 			echo '<script>alert("Debe llenar todos los campos correctamente.");</script>';
		// // 		}
				
		// // 	}
		// // }

		// #Abrir la sesión de Paciente.
		// static public function iniciarSesionCtl(){
		// 	if (isset($_POST["Paciente"]) && isset($_POST["contrasena"])) {
		// 		$pic = Pic::progPic($_POST["contrasena"]);
		// 		$respuesta = CRUDPaciente::iniciarSesionBD($_POST["Paciente"], $pic);
		// 		if ($respuesta["Paciente"] == null) {
		// 			echo '<script>toast("Datos incorrectos!.");</script>';
		// 		}elseif ($respuesta["Paciente"] == $_POST["Paciente"] && $respuesta["contrasena"] == $pic) {
		// 			$existePaciente = CRUDPaciente::existePacienteBD($respuesta["idPaciente"]);
		// 			if ($existePaciente["nombre"] != null) {
		// 				$datosPaciente = CRUDPaciente::seleccionarPacienteSesionBD($respuesta["idPaciente"]);
		// 				$conectarPaciente = CRUDPaciente::conectarPacienteBD($respuesta["idPaciente"]);
		// 				if ($datosPaciente["nombre"] == null) {
		// 					echo '<script>window.location = "IniciarSesion";</script>';
		// 				}elseif ($datosPaciente["idPaciente"] == $respuesta["idPaciente"] && $conectarPaciente == true) {
		// 					$_SESSION["ingresado"] = $datosPaciente["nombre"];
		// 					$_SESSION["Paciente"] = $datosPaciente["idPaciente"];
		// 					$_SESSION["tipo-Paciente"] = $datosPaciente["tipoPaciente"];
		// 					echo '<script>window.location = "Inicio";</script>';
		// 				}
		// 			} else {
		// 				echo '<script>toast("Datos incorrectos!.");</script>';
		// 			}
		// 		}
		// 	}
		// }
		
		// // #Cerrar la sesión de Paciente.
		// static public function desconectarPacienteCtl($idPaciente){
		// 	$desconectar = CRUDPaciente::desconectarPacienteBD($idPaciente);
		// 	return $desconectar;
		// }

		#Actualizar la información del paciente.
		static public function actualizarAtributosCtl(){
			if (
				isset($_POST["idPacienteAtributos-a"]) && 
				isset($_POST["pacienteNombre-a"]) && 
				isset($_POST["pacienteApellidos-a"]) && 
				isset($_POST["pacienteFecha-a"]) && 
				isset($_POST["pacienteOcupacion-a"])
				) {
					if (
						Validacion::nombresPropios($_POST["pacienteNombre-a"], 2, 30) && 
						Validacion::nombresPropios($_POST["pacienteApellidos-a"], 2, 50) && 
						Validacion::nombresPropios($_POST["pacienteOcupacion-a"], 0, 45)
					) {
						$actualizarAttr = false;
						$actualizarPaciente = false;
						$idPaciente = $_POST["idPacienteAtributos-a"];
						$datosPaciente = array(
							"idPaciente" => $_POST["idPacienteAtributos-a"], 
							"nombre" => $_POST["pacienteNombre-a"], 
							"apellidos" => $_POST["pacienteApellidos-a"]
						);
						$attr = array(
							"fecha" => $_POST["pacienteFecha-a"], 
							"sexo" => null, 
							"edoCivil" => null, 
							"ocupacion" => $_POST["pacienteOcupacion-a"], 
						);
						isset($_POST["pacienteEdoCivil-a"]) ? $attr["edoCivil"] = $_POST["pacienteEdoCivil-a"] : null;
						isset($_POST["pacienteSexo-a"]) ? $attr["sexo"] = $_POST["pacienteSexo-a"] : null;
						$hayAttr = CRUDPaciente::hayAtributosBD($idPaciente);
						if ($hayAttr["attr"] == 0) {
							$actualizarAttr = CRUDPaciente::nuevosAtributosBD($idPaciente, $attr);
							$actualizarPaciente = CRUDPaciente::actualizarPacienteBD($datosPaciente);
						} else if($hayAttr["attr"] > 0){
							$actualizarAttr = CRUDPaciente::actualizarAtributosBD($idPaciente, $attr);
							$actualizarPaciente = CRUDPaciente::actualizarPacienteBD($datosPaciente);
						}

						if ($actualizarAttr && $actualizarPaciente) {
							echo '<script>toast("Información actualizada.");</script>';
						} else {
							echo '<script>toast("Ocurrió un error al actualizar.");</script>';
						}
					} else {
						echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
					}
			}
		}
		
		#Crear o actualizar atributos del paciente.
		static public function nuevoPacienteCtl(){
			if (
				isset($_POST["idCitaC"]) && 
				isset($_POST["pacienteNombre-N"]) && 
				isset($_POST["pacienteApellidos-N"]) && 
				isset($_POST["pacienteTelefono-N"])
				) {
					if (
						Validacion::nombresPropios($_POST["pacienteNombre-N"], 2, 30) && 
						Validacion::nombresPropios($_POST["pacienteApellidos-N"], 2, 50) && 
						Validacion::enterosSinIntervalo($_POST["pacienteTelefono-N"], 10)
					) {
						$idCita = $_POST["idPacienteAtributos-a"];
						$datosPaciente = array(
							"nombre" => $_POST["pacienteNombre-N"], 
							"apellidos" => $_POST["pacienteApellidos-N"]
						);
						$nuevoPaciente = CRUDPaciente::nuevoPacienteBD($datosPaciente);
						$ultimoPaciente = CRUDPaciente::ultimoPacienteBD();
						$datosTelefono = array(
							"idPersona" => $ultimoPaciente["idUsuario"], 
							"telefono" => $_POST["pacienteTelefono-N"], 
							"tipo" => '1'
						);
						$telefonoPaciente = CRUD::nuevoTelefonoBD($datosTelefono, 1);
						if ($nuevoPaciente && $telefonoPaciente) {
							$quitarCita = CRUDExterno::quitarCitaBD($idCita);
							echo '<script>
									toast("Paciente guardado.");
									window.location = "index.php?pagina=PacienteInfo&expediente='.$ultimoPaciente["idUsuario"].'";
								</script>';
						}else{
							echo '<script>toast("Ha ocurrido un error, intente de nuevo");</script>
								';
							}
						} else {
						echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
					}
			}
		}

		// #Deshabilitar uno o más Pacientes.
		// static public function eliminarPacientesCtl($Pacientes){
		// 	$respuestas = array();
		// 	$conclusion = true;
		// 	for ($i = 0; $i < sizeof($Pacientes); $i++) {
		// 		$respuesta = CRUDPaciente::eliminarPacientesBD($Pacientes[$i]);
		// 		if ($respuesta == false) {
		// 			$respuestas[$i] = false;
		// 		}
		// 	}
			
		// 	for ($i = 0; $i < sizeof($respuestas); $i++) {
		// 		if ($respuestas[$i] == false) {
		// 			$conclusion = false;
		// 		}
		// 	}
		// 	return $conclusion;
		// }
	}
<?php
	class ControladorUsuario{
		#Buscar usuarios.
		static public function buscarUsuariosCtl($buscar) {
			$respuesta = CRUDUsuario::buscarUsuariosBD($buscar);
			return $respuesta;
		}

		#Seleccionar los usuarios 
		static public function selUsuariosCtl(){
			$respuesta = CRUDUsuario::selUsuariosBD();
			return $respuesta;
		}
		
		#Contar los usuarios 
		static public function contarUsuariosCtl(){
			$respuesta = CRUDUsuario::contarUsuariosBD();
			return $respuesta;
		}

		// #Seleccionar estado de conexión de los usuarios activos.
		// static public function seleccionarConexionUsuariosCtl(){
		// 	$respuesta = CRUDUsuario::seleccionarConexionUsuariosBD();
		// 	return $respuesta;
		// }

		#Recuperar datos de usuario.
		static public function datosUsuarioCtl($idUsuario){
			$respuesta = CRUDUsuario::datosUsuarioBD($idUsuario);
			return $respuesta;
		}

		// #Seleccionar todos los usuarios de tipo médico.
		// static public function medicosCtl() {
		// 	$respuesta = CRUDUsuario::medicosBD();
		// 	return $respuesta;
		// }

		#Actualizar datos de usuario.
		static public function actualizarUsuarioCtl(){
			if (
				isset($_POST["idUsuario-A"]) && 
				isset($_POST["usuarioNombre-A"]) && 
				isset($_POST["usuarioApellidos-A"]) && 
				isset($_POST["usuarioCargo-A"])
				) {
				if (
					Validacion::nombresPropios($_POST["usuarioNombre-A"], 2, 30) && 
					Validacion::nombresPropios($_POST["usuarioApellidos-A"], 2, 50)
				) {
					$datosUsuario = array(
						"idUsuario" => $_POST["idUsuario-A"], 
						"nombre" => $_POST["usuarioNombre-A"], 
						"apellidos" => $_POST["usuarioApellidos-A"], 
						"cargo" => $_POST["usuarioCargo-A"]
					);
					$respuesta = CRUDUsuario::actualizarUsuarioBD($datosUsuario);
					if($respuesta) {
						echo '<script>toast("Datos actualizados");</script>
						';
					}else{
						echo '<script>toast("Error al actualizar");</script>
						';
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
				
			}
		}

		#Actualizar contraseña de usuario.
		static public function actualizarPicCtl(){
			if (
				isset($_POST["pwdUsuarioId"]) && 
				isset($_POST["pwdActual"]) && 
				isset($_POST["pwdNueva"])
				) {
				if (Validacion::contrasenas($_POST["pwdNueva"], 30)) {
					$picOld = Pic::progPic($_POST["pwdActual"]);
					$picNew = Pic::progPic($_POST["pwdNueva"]);
					$pic = array(
						"idUsuario" => $_POST["pwdUsuarioId"], 
						"pwdActual" => $picOld, 
						"pwdNueva" => $picNew
					);
					$PicOld = CRUDUsuario::verificarPicOldBD($pic);
					if ($PicOld == null) {
						echo '<script>toast("La contraseña actual es incorrecta.");</script>';
					} else {
						$respuesta =CRUDUsuario::actualizarPicBD($pic);
						if($respuesta) {
							echo '<script>toast("Listo, ¡contraseña actualizada!");</script>';
						}else{
							echo '<script>toast("Error al actualizar la contraseña.");</script>';
						}
					}
				} else {
					echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
				}
				
			}
		}

		#Abrir la sesión de usuario.
		static public function iniciarSesionCtl(){
			if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
				$pic = Pic::progPic($_POST["contrasena"]);
				$respuesta = CRUDUsuario::iniciarSesionBD($_POST["usuario"], $pic);
				if ($respuesta["usuario"] == null) {
					echo '<script>toast("Datos incorrectos!.");</script>';
				}elseif ($respuesta["usuario"] == $_POST["usuario"] && $respuesta["contrasena"] == $pic) {
					$existeUsuario = CRUDUsuario::existeUsuarioBD($respuesta["idUsuario"]);
					if ($existeUsuario["nombre"] != null) {
						$datosUsuario = CRUDUsuario::seleccionarUsuarioSesionBD($respuesta["idUsuario"]);
						$conectarUsuario = CRUDUsuario::conectarUsuarioBD($respuesta["idUsuario"]);
						if ($datosUsuario["nombre"] == null) {
							echo '<script>window.location = "IniciarSesion";</script>';
						}elseif ($datosUsuario["idUsuario"] == $respuesta["idUsuario"] && $conectarUsuario == true) {
							$_SESSION["ingresado"] = $datosUsuario["nombre"];
							$_SESSION["usuario"] = $datosUsuario["idUsuario"];
							$_SESSION["tipo-usuario"] = $datosUsuario["tipoUsuario"];
							echo '<script>window.location = "Inicio";</script>';
						}
					} else {
						echo '<script>toast("Datos incorrectos!.");</script>';
					}
				}
			}
		}
		
		// #Cerrar la sesión de usuario.
		static public function desconectarUsuarioCtl($idUsuario){
			$desconectar = CRUDUsuario::desconectarUsuarioBD($idUsuario);
			return $desconectar;
		}

		#Crear cuenta de usuario.
		static public function crearCuentaCtl(){
			if (
				isset($_POST["usuarioNombre-N"]) && 
				isset($_POST["usuarioApellidos-N"]) && 
				isset($_POST["usuario-N"]) && 
				isset($_POST["usuarioPwd-N"]) && 
				isset($_POST["usuarioCargo-N"])
				) {
				if (CRUDUsuario::validarUsuarioBD($_POST["usuario-N"]) != null) {
					echo '<script>toast("Debe elegir otro nombre de usuario");</script>';
				} else {
					if (
						Validacion::nombresPropios($_POST["usuarioNombre-N"], 2, 30) && 
						Validacion::nombresPropios($_POST["usuarioApellidos-N"], 2, 50) && 
						Validacion::nombresUsuarios($_POST["usuario-N"], 2, 30) && 
						Validacion::contrasenas($_POST["usuarioPwd-N"], 8)
					) {
						$pic = Pic::progPic($_POST["usuarioPwd-N"]);
						$datosUsuario = array(
							"nombre" => $_POST["usuarioNombre-N"], 
							"apellidos" => $_POST["usuarioApellidos-N"], 
							"usuario" => $_POST["usuario-N"], 
							"contrasena" => $pic, 
							"tipoUsuario" => $_POST["usuarioCargo-N"]
						);
						$crearUsuarioYCuenta = CRUDUsuario::crearCuentaBD($datosUsuario);
						if ($crearUsuarioYCuenta) {
							echo '<script>toast("Usuario creado");</script>
								';
						}else{
							echo '<script>toast("Ha ocurrido un error consulte al desarrollador");</script>
								';
						}
					} else {
						echo '<script>toast("Debe llenar todos los campos correctamente.");</script>';
					}
				}
			}
		}

		#Deshabilitar uno o más usuarios.
		static public function eliminarUsuariosCtl($usuarios){
			$respuestas = array();
			$conclusion = true;
			for ($i = 0; $i < sizeof($usuarios); $i++) {
				$respuesta = CRUDUsuario::eliminarUsuariosBD($usuarios[$i]);
				if ($respuesta == false) {
					$respuestas[$i] = false;
				}
			}
			
			for ($i = 0; $i < sizeof($respuestas); $i++) {
				if ($respuestas[$i] == false) {
					$conclusion = false;
				}
			}
			return $conclusion;
		}

		#Seleccionar la configuración del sistema.
		static public function selConfigCtl($idUsuario) {
			$respuesta = CRUDUsuario::selConfigBD($idUsuario);
			return $respuesta;
		}
		
		#Seleccionar la configuración de hora del sistema.
		static public function selConfigHoraCtl($idUsuario) {
			$respuesta = CRUDUsuario::selConfigHoraBD($idUsuario);
			return $respuesta;
		}
		
		#Establecer nuevo horario laboral.
		static public function nuevoHorarioCtl() {
			if (
				isset($_POST["horarioHoraA-n"]) && 
				isset($_POST["horarioHoraC-n"]) && 
				isset($_POST["horarioUsuarioId-n"])
			) {
				// echo '<script>toast("'.$_POST["horarioDia1-n"].'");</script>';
				$idUsuario = $_POST["horarioUsuarioId-n"];
				$horario = array(
					'horaA' => $_POST["horarioHoraA-n"], 
					'horaC' => $_POST["horarioHoraC-n"]
				);
				isset($_POST["horarioDia1-n"]) ? $horario["d1"] = true : $horario["d1"] = false;
				isset($_POST["horarioDia2-n"]) ? $horario["d2"] = true : $horario["d2"] = false;
				isset($_POST["horarioDia3-n"]) ? $horario["d3"] = true : $horario["d3"] = false;
				isset($_POST["horarioDia4-n"]) ? $horario["d4"] = true : $horario["d4"] = false;
				isset($_POST["horarioDia5-n"]) ? $horario["d5"] = true : $horario["d5"] = false;
				isset($_POST["horarioDia6-n"]) ? $horario["d6"] = true : $horario["d6"] = false;
				isset($_POST["horarioDia7-n"]) ? $horario["d7"] = true : $horario["d7"] = false;
				$horarioJSON = json_encode($horario);
				if ($idUsuario == 1) {
					$config = CRUDUsuario::nuevoHorarioBD($idUsuario, $horarioJSON);
					if ($config) {
						echo '<script>toast("Horario laboral establecido.");</script>';
					} else {
						echo '<script>toast("Ocurrió un error, intente de nuevo.");</script>';
					}
				} else {
					echo '<script>toast("Ocurrió un error, ¡Intente de nuevo!");</script>';
				}
			}
		}
	}
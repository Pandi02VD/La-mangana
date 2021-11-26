<?php
	class ControladorUsuario{
		// #Buscar usuario.
		// public function buscarUsuarioCtl($search) {
		// 	$respuesta = CRUDUsuario::buscarUsuarioBD($search);
		// 	return $respuesta;
		// }

		// #Seleccionar los usuarios 
		// public function seleccionarUsuariosCtl(){
		// 	$respuesta = CRUDUsuario::seleccionarUsuariosBD();
		// 	return $respuesta;
		// }

		// #Seleccionar estado de conexión de los usuarios activos.
		// public function seleccionarConexionUsuariosCtl(){
		// 	$respuesta = CRUDUsuario::seleccionarConexionUsuariosBD();
		// 	return $respuesta;
		// }

		// #Recuperar datos de usuario.
		// public function datosUsuarioCtl($usuarioId){
		// 	$respuesta = CRUDUsuario::datosUsuarioBD($usuarioId);
		// 	return $respuesta;
		// }

		// #Seleccionar todos los usuarios de tipo médico.
		// public function medicosCtl() {
		// 	$respuesta = CRUDUsuario::medicosBD();
		// 	return $respuesta;
		// }

		// #Actualizar datos de usuario.
		// public function actualizarUsuarioCtl(){
		// 	if (
		// 		isset($_POST["usuarioId-edit"]) && 
		// 		isset($_POST["nombre-edit"]) && 
		// 		isset($_POST["tipo-usuario-edit"])
		// 		) {
		// 		if (Validacion::nombresPropios($_POST["nombre-edit"], 2, 50)) {
		// 			$datosUsuario = array(
		// 				"idUsuario" => $_POST["usuarioId-edit"], 
		// 				"nombre" => $_POST["nombre-edit"], 
		// 				"tipo" => $_POST["tipo-usuario-edit"]
		// 			);
		// 			$respuesta = CRUDUsuario::actualizarUsuarioBD($datosUsuario);
		// 			if($respuesta) {
		// 				echo '
		// 					<script>
		// 						window.location = "index.php?pagina=Usuarios";
		// 						alert("Datos actualizados");
		// 					</script>
		// 				';
		// 			}else{
		// 				echo '
		// 					<script>
		// 						alert("Error al actualizar");
		// 						window.location = "index.php?pagina=Usuarios";
		// 					</script>
		// 				';
		// 			}
		// 		} else {
		// 			echo '<script>alert("Debe llenar todos los campos correctamente.");</script>';
		// 		}
				
		// 	}
		// }
		
		// #Actualizar contraseña de usuario.
		// public function actualizarPicCtl(){
		// 	if (
		// 		isset($_POST["usuarioId"]) && 
		// 		isset($_POST["contrasena-old"]) && 
		// 		isset($_POST["contrasena-edit"])
		// 		) {
		// 		if (Validacion::contrasenas($_POST["contrasena-edit"], 30)) {
		// 			$picOld = Pic::progPic($_POST["contrasena-old"]);
		// 			$picNew = Pic::progPic($_POST["contrasena-edit"]);
		// 			$datosPic = array(
		// 				"usuarioId" => $_POST["usuarioId"], 
		// 				"contrasenaOld" => $picOld, 
		// 				"contrasenaNew" => $picNew
		// 			);
		// 			$PicOld = CRUDUsuario::verificarPicOldBD($datosPic);
		// 			if ($PicOld == null) {
		// 				echo '<script>toast("La contraseña anterior no es válida");</script>';
		// 			} else {
		// 				$respuesta =CRUDUsuario::actualizarPicBD($datosPic);
		// 				if($respuesta) {
		// 					echo '
		// 						<script>
		// 							window.location = "index.php?pagina=Usuarios";
		// 							alert("Datos actualizados");
		// 						</script>
		// 					';
		// 				}else{
		// 					echo '
		// 						<script>
		// 							alert("Error al actualizar");
		// 							window.location = "index.php?pagina=Usuarios";
		// 						</script>
		// 					';
		// 				}   
		// 			}
		// 		} else {
		// 			echo '<script>alert("Debe llenar todos los campos correctamente.");</script>';
		// 		}
				
		// 	}
		// }

		#Abrir la sesión de usuario.
		public function iniciarSesionCtl(){
			if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
				$pic = $_POST["contrasena"];
				// $pic = Pic::progPic($_POST["contrasena"]);
				$respuesta = CRUDUsuario::iniciarSesionBD($_POST["usuario"], $pic);
				if ($respuesta["usuario"] == null) {
					echo '<script>toast("Datos incorrectos!.");</script>';
				}elseif ($respuesta["usuario"] == $_POST["usuario"] && $respuesta["contrasena"] == $pic) {
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
				}
			}
		}
		
		// #Cerrar la sesión de usuario.
		public function desconectarUsuarioCtl($idUsuario){
			$desconectar = CRUDUsuario::desconectarUsuarioBD($idUsuario);
			return $desconectar;
		}

		// #Crear cuenta de usuario.
		// public function crearCuentaCtl(){
		// 	if (
		// 		isset($_POST["tipo-usuario-new"]) && 
		// 		isset($_POST["nombre-new"]) && 
		// 		isset($_POST["usuario-new"]) && 
		// 		isset($_POST["contrasena-new"])
		// 		) {
		// 		if (
		// 			Validacion::nombresPropios($_POST["nombre-new"], 2, 50) && 
		// 			Validacion::nombresUsuarios($_POST["usuario-new"], 2, 50) && 
		// 			Validacion::contrasenas($_POST["contrasena-new"], 50)
		// 		) {
		// 			$pic = Pic::progPic($_POST["contrasena-new"]);
		// 			$datosUsuario = array(
		// 				"tipo" => $_POST["tipo-usuario-new"], 
		// 				"nombre" => $_POST["nombre-new"], 
		// 				"usuario" => $_POST["usuario-new"], 
		// 				"contrasena" => $pic
		// 			);
		// 			$crearUsuario = CRUDUsuario::crearCuentaBD($datosUsuario);
		// 			if ($crearUsuario) {
		// 				echo '
		// 					<script>
		// 						window.location = "index.php?pagina=Usuarios";
		// 						alert("Usuario creado");
		// 					</script>
		// 					';
		// 			}else{
		// 				echo '
		// 					<script>
		// 						window.location = "index.php?pagina=Usuarios";
		// 						alert("Ha ocurrido un error consulte al desarrollador");
		// 					</script>
		// 					';
		// 			}
		// 		} else {
		// 			echo '<script>alert("Debe llenar todos los campos correctamente.");</script>';
		// 		}
				
		// 	}
		// }

		// #Deshabilitar uno o más usuarios.
		// public function eliminarUsuariosCtl($usuariosElegidosEliminar){
		// 	$respuestas = array();
		// 	$conclusion = true;
		// 	for ($i = 0; $i < sizeof($usuariosElegidosEliminar); $i++) {
		// 		$respuesta = CRUDUsuario::eliminarUsuariosBD($usuariosElegidosEliminar[$i]);
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
<?php
	class CRUDUsuario{
		#Buscar usuarios en la base de datos.
		static public function buscarUsuariosBD($buscar){
			$sql = Conexion::conectar() -> prepare(
				"SELECT idUsuario, nombre, apellidos, tipoUsuario, estado, 
				date_format(fechaRegistro, '%d/%b/%Y') fechaRegistro 
				FROM usuario
				WHERE (nombre LIKE '%$buscar%' 
				OR apellidos LIKE '%$buscar%') 
				AND estado = 1 AND tipoUsuario > 0;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar usuarios de la base de datos.
		static public function selUsuariosBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.idUsuario, u.nombre, u.apellidos, u.tipoUsuario, 
				u_a.estado, date_format(u.fechaRegistro, '%d/%b/%Y') fechaRegistro 
				FROM usuario u 
				INNER JOIN usuario_acceso u_a ON u.idUsuario = u_a.idUsuario 
				WHERE u.estado = 1 AND u.tipoUsuario > 0;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql -> close();
			$sql = null;
		}
		
		#Contar usuarios de la base de datos.
		static public function contarUsuariosBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as totalUsuarios FROM usuario 
				WHERE estado = 1 AND tipoUsuario > 0;"
			);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar usuarios de la base de datos.
		static public function existeUsuarioBD($idUsuario){
			$sql = Conexion::conectar() -> prepare(
				"SELECT nombre FROM usuario 
				WHERE idUsuario = :idUsuario AND estado = 1;"
			);
			$sql -> bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		// #Seleccionar estado de conexión de los usuarios activos de la base de datos.
		// static public function seleccionarConexionUsuariosBD(){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT u.idUsuario, u_a.estado FROM usuario u 
		// 		INNER JOIN usuario_acceso u_a ON u.idUsuario = u_a.idUsuario 
		// 		WHERE u.estado = 1 AND u.tipo > 0;"
		// 	);
		// 	$sql -> execute();
		// 	return $sql -> fetchAll();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Confirmar los datos de un usuario al iniciar sesión
		static public function iniciarSesionBD($usuario, $contrasena){
			$sql = Conexion::conectar() -> prepare(
				"SELECT idUsuario, usuario, contrasena, estado 
				FROM usuario_acceso 
				WHERE usuario = :usuario AND contrasena = :contrasena AND estado = 0;"
			);
			$sql ->bindParam(":usuario",$usuario,PDO::PARAM_STR);
			$sql ->bindParam(":contrasena",$contrasena,PDO::PARAM_STR);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		// #Seleccionar usuario que inició sesión en el sistema desde la base de datos.
		static public function seleccionarUsuarioSesionBD($usuarioSesion){
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.nombre, u.tipoUsuario, u_a.idUsuario, u_a.usuario, u_a.estado 
				FROM usuario u INNER JOIN usuario_acceso u_a ON u_a.idUsuario = u.idUsuario WHERE u.idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $usuarioSesion, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		// #Cambiar a desconectado el estado del usuario hacia la base de datos.
		static public function desconectarUsuarioBD($idUsuario){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_acceso SET estado = 0 WHERE idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		// #Cambiar a conectado el estado del usuario hacia la base de datos.
		static public function conectarUsuarioBD($usuario){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_acceso SET estado = 1 WHERE idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $usuario, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		#Recuperar datos de usuario de la base de datos para editarlos.
		static public function datosUsuarioBD($idUsuario){
			$sql = Conexion::conectar() -> prepare(
				"SELECT idUsuario, nombre, apellidos, tipoUsuario 
				FROM usuario 
				WHERE tipoUsuario > 0 
				AND tipoUsuario < 6 
				AND estado = 1 
				AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		// #Seleccionar todos los usuarios de tipo médico.
		// static public function medicosBD() {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT idUsuario, nombre FROM usuario 
		// 		WHERE tipo = 3 AND estado = 1;"
		// 	);
		// 	$sql -> execute();
		// 	return $sql -> fetchAll();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		#Actualizar datos de usuario en la base de datos.
		static public function actualizarUsuarioBD($datosUsuario){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario 
				SET nombre = :nombre, apellidos = :apellidos, tipoUsuario = :tipoUsuario 
				WHERE idUsuario = :idUsuario AND tipoUsuario != 1;"
			);
			$sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":apellidos", $datosUsuario["apellidos"], PDO::PARAM_STR);
			$sql -> bindParam(":tipoUsuario", $datosUsuario["cargo"], PDO::PARAM_INT);
			$sql -> bindParam(":idUsuario", $datosUsuario["idUsuario"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Actualizar contraseña de usuario en la base de datos.
		static public function actualizarPicBD($pic){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_acceso SET contrasena = :contrasena WHERE idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $pic["idUsuario"], PDO::PARAM_INT);
			$sql -> bindParam(":contrasena", $pic["pwdNueva"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Verificar la contraseña de usuario en la base de datos.
		static public function verificarPicOldBD($pic){
			$sql = Conexion::conectar() -> prepare(
				"SELECT contrasena FROM usuario_acceso WHERE idUsuario = :idUsuario AND contrasena = :contrasena;"
			);
			$sql -> bindParam(":idUsuario", $pic["idUsuario"], PDO::PARAM_INT);
			$sql -> bindParam(":contrasena", $pic["pwdActual"], PDO::PARAM_STR);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Validar usuario en la base de datos.
		static public function validarUsuarioBD($usuario){
			$sql = Conexion::conectar() -> prepare(
				"SELECT idUsuarioAcceso FROM usuario_acceso WHERE usuario = :usuario;"
			);
			$sql -> bindParam(":usuario", $usuario, PDO::PARAM_STR);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Crear cuenta de usuario en la base de datos.
		static public function crearCuentaBD($datosUsuario){
			$transaccion = true;
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO usuario(nombre, apellidos, fechaRegistro, tipoUsuario, estado) 
				VALUE(:nombre, :apellidos, now(), :tipoUsuario, 2);"
			);
			$sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":apellidos", $datosUsuario["apellidos"], PDO::PARAM_STR);
			$sql -> bindParam(":tipoUsuario", $datosUsuario["tipoUsuario"], PDO::PARAM_INT);
			if ($sql -> execute()) {
				$transaccion = true;
			}else{
				return false;
				$sql -> close();
				$sql = null;
			}

			if ($transaccion) {
				$sql2 = Conexion::conectar() -> prepare(
					"SELECT idUsuario FROM usuario 
					WHERE nombre = :nombre 
					AND tipoUsuario = :tipoUsuario 
					AND estado = 2;"
				);
				$sql2 -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
				$sql2 -> bindParam(":tipoUsuario", $datosUsuario["tipoUsuario"], PDO::PARAM_INT);
				$sql2 -> execute();
				$usuario = $sql2 -> fetch();
				$crearAcceso = CRUDUsuario::crearAccesoUsuarioBD($usuario, $datosUsuario);
				if ($crearAcceso) {
					$sql3 = Conexion::conectar() -> prepare(
						"UPDATE usuario set estado = 1 where idUsuario = :idUsuario AND estado = 2;"
					);
					$sql3 -> bindParam(":idUsuario", $usuario["idUsuario"], PDO::PARAM_INT);
					if ($sql3 -> execute()) {
						return true;
					}else{
						return false;
					}
				}
			}
			$sql -> close();
			$sql2 -> close();
			$sql3 -> close();
			$sql = null;
			$sql2 = null;
			$sql3 = null;
		}

		#Crear acceso de usuario en la base de datos.
		static public function crearAccesoUsuarioBD($usuario, $datosAcceso){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO usuario_acceso(idUsuario, usuario, contrasena, fechaRegistro, estado) 
				VALUE(:idUsuario, :usuario, :contrasena, now(), 0);"
			);
			$sql -> bindParam(":idUsuario", $usuario["idUsuario"], PDO::PARAM_INT);
			$sql -> bindParam(":usuario", $datosAcceso["usuario"], PDO::PARAM_STR);
			$sql -> bindParam(":contrasena", $datosAcceso["contrasena"], PDO::PARAM_STR);
			if($sql -> execute()){
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		#Deshabilitar uno o más usuarios del sistema.
		static public function eliminarUsuariosBD($idUsuario){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario SET estado = 0 WHERE tipoUsuario != 1 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return $idUsuario;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar la configuración del sistema.
		static public function selConfigBD($idUsuario){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM config WHERE idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar la configuración de hora del sistema.
		static public function selConfigHoraBD($idUsuario){
			$sql = Conexion::conectar() -> prepare(
				"SELECT configJSON FROM config WHERE idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Establecer nuevo horario laboral.
		static public function nuevoHorarioBD($idUsuario, $horarioJSON){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO config(idUsuario, configJSON, fechaRegistro, fechaEdicion, estado) 
				VALUE(:idUsuario, :configJSON, now(), now(), 1);"
			);
			$sql -> bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			$sql -> bindParam(":configJSON", $horarioJSON);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}
	}
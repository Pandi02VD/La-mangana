<?php
	class CRUDUsuario{
		// #Buscar usuario en la base de datos.
		// public function buscarUsuarioBD($search){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT u.iduser, u.nombre, u.tipo, u.fecha, u_a.estado, 
		// 		date_format(u.fecha, '%d/%M/%Y') fecha 
		// 		FROM user u 
		// 		INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
		// 		WHERE nombre LIKE '%$search%' AND u.estado = 1 AND u.tipo > 0;"
		// 	);
		// 	$sql -> execute();			
		// 	return $sql -> fetchAll();
		// 	$sql -> close();
		// 	$sql = null;
		// }
		
		// #Seleccionar usuarios de la base de datos.
		// public function seleccionarUsuariosBD(){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT u.iduser, u.nombre, u.tipo, u.fecha, u_a.estado, 
		// 		date_format(u.fecha, '%d/%M/%Y') fecha 
		// 		FROM user u 
		// 		INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
		// 		WHERE u.estado = 1 AND u.tipo > 0;"
		// 	);
		// 	$sql -> execute();
		// 	return $sql -> fetchAll();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Seleccionar estado de conexión de los usuarios activos de la base de datos.
		// public function seleccionarConexionUsuariosBD(){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT u.iduser, u_a.estado FROM user u 
		// 		INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
		// 		WHERE u.estado = 1 AND u.tipo > 0;"
		// 	);
		// 	$sql -> execute();
		// 	return $sql -> fetchAll();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Confirmar los datos de un usuario al iniciar sesión
		public function iniciarSesionBD($usuario, $contrasena){
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
		public function seleccionarUsuarioSesionBD($usuarioSesion){
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
		public function desconectarUsuarioBD($idUsuario){
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
		public function conectarUsuarioBD($usuario){
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

		// #Recuperar datos de usuario de la base de datos.
		// public function datosUsuarioBD($usuarioId){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT iduser, nombre, tipo, fecha, 
		// 		date_format(fecha, '%d de %M de %Y') fecha 
		// 		FROM user 
		// 		WHERE tipo > 0 AND tipo < 4 AND estado = 1 AND iduser = :iduser;"
		// 	);
		// 	$sql -> bindParam(":iduser", $usuarioId, PDO::PARAM_INT);
		// 	$sql -> execute();
		// 	return $sql -> fetch();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Seleccionar todos los usuarios de tipo médico.
		// public function medicosBD() {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT iduser, nombre FROM user 
		// 		WHERE tipo = 3 AND estado = 1;"
		// 	);
		// 	$sql -> execute();
		// 	return $sql -> fetchAll();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Actualizar datos de usuario en la base de datos.
		// public function actualizarUsuarioBD($datosUsuario){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE user SET nombre = :nombre, tipo = :tipo WHERE iduser = :iduser;"
		// 	);
		// 	$sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
		// 	$sql -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
		// 	$sql -> bindParam(":iduser", $datosUsuario["iduser"], PDO::PARAM_INT);
		// 	if($sql -> execute()) {
		// 		return true;
		// 	}else{
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }
		
		// #Actualizar contraseña de usuario en la base de datos.
		// public function actualizarPicBD($datosPic){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE user_acceso SET contrasena = :contrasena WHERE iduser = :iduser;"
		// 	);
		// 	$sql -> bindParam(":iduser", $datosPic["usuarioId"], PDO::PARAM_INT);
		// 	$sql -> bindParam(":contrasena", $datosPic["contrasenaNew"], PDO::PARAM_STR);
		// 	if($sql -> execute()) {
		// 		return true;
		// 	}else{
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }
		
		// #Verificar la contraseña de usuario en la base de datos.
		// public function verificarPicOldBD($datosPic){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT contrasena FROM user_acceso WHERE iduser = :iduser AND contrasena = :contrasena;"
		// 	);
		// 	$sql -> bindParam(":iduser", $datosPic["usuarioId"], PDO::PARAM_INT);
		// 	$sql -> bindParam(":contrasena", $datosPic["contrasenaOld"], PDO::PARAM_STR);
		// 	$sql -> execute();
		// 	return $sql -> fetch();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Crear cuenta de usuario en la base de datos.
		// public function crearCuentaBD($datosUsuario){
		// 	$transaccion = true;
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"INSERT INTO user(nombre, fecha, tipo, estado) VALUE(:nombre, now(), :tipo, 2);"
		// 	);
		// 	$sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
		// 	$sql -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
		// 	if ($sql -> execute()) {
		// 		$transaccion = true;
		// 	}else{
		// 		return false;
		// 		$sql -> close();
		// 		$sql = null;
		// 	}

		// 	if ($transaccion) {
		// 		$sql2 = Conexion::conectar() -> prepare(
		// 			"select iduser from user where nombre = :nombre AND tipo = :tipo AND estado = 2;"
		// 		);
		// 		$sql2 -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
		// 		$sql2 -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
		// 		$sql2 -> execute();
		// 		$usuario = $sql2 -> fetch();
		// 		$crearAcceso = CRUDUsuario::crearAccesoUsuarioBD($usuario, $datosUsuario);
		// 		if ($crearAcceso) {
		// 			$sql3 = Conexion::conectar() -> prepare(
		// 				"UPDATE user set estado = 1 where iduser = :iduser AND estado = 2;"
		// 			);
		// 			$sql3 -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
		// 			if ($sql3 -> execute()) {
		// 				return true;
		// 			}else{
		// 				return false;
		// 			}
		// 		}
		// 	}
		// 	$sql -> close();
		// 	$sql2 -> close();
		// 	$sql3 -> close();
		// 	$sql = null;
		// 	$sql2 = null;
		// 	$sql3 = null;
		// }

		// #Crear acceso de usuario en la base de datos.
		// public function crearAccesoUsuarioBD($usuario, $datosAcceso){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"INSERT INTO user_acceso(iduser, usuario, contrasena, fecha, estado) 
		// 		VALUE(:iduser, :usuario, :contrasena, now(), 0);"
		// 	);
		// 	$sql -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
		// 	$sql -> bindParam(":usuario", $datosAcceso["usuario"], PDO::PARAM_STR);
		// 	$sql -> bindParam(":contrasena", $datosAcceso["contrasena"], PDO::PARAM_STR);
		// 	if($sql -> execute()){
		// 		return true;
		// 	}else{
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Deshabilitar uno o más usuarios del sistema.
		// public function eliminarUsuariosBD($usuarioId){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE user SET estado = 0 WHERE tipo != 1 AND iduser = :iduser;"
		// 	);
		// 	$sql -> bindParam(":iduser", $usuarioId, PDO::PARAM_INT);
		// 	if ($sql -> execute()) {
		// 		return $usuarioId;
		// 	}else{
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }
	}
<?php
	class CRUDUsuario{
		#Buscar usuario en la base de datos.
		static public function buscarUsuarioBD($search){
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.iduser, u.nombre, u.tipo, u.fecha, u_a.status, 
				date_format(u.fecha, '%d/%M/%Y') fecha 
				FROM user u 
				INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
				WHERE nombre LIKE '%$search%' AND u.status = 1 AND u.tipo > 0;"
			);
			$sql -> execute();			
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Seleccionar usuarios de la base de datos.
		static public function seleccionarUsuariosBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.iduser, u.nombre, u.tipo, u.fecha, u_a.status, 
				date_format(u.fecha, '%d/%M/%Y') fecha 
				FROM user u 
				INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
				WHERE u.status = 1 AND u.tipo > 0;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Seleccionar estado de conexión de los usuarios activos de la base de datos.
		static public function seleccionarConexionUsuariosBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.iduser, u_a.status FROM user u 
				INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
				WHERE u.status = 1 AND u.tipo > 0;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Confirmar los datos de un usuario al iniciar sesión
		static public function iniciarSesionBD($usuario, $contrasena){
			$sql = Conexion::conectar() -> prepare(
				"SELECT iduser, usuario, contrasena, status FROM 
				user_acceso WHERE usuario = :usuario AND contrasena = :contrasena AND status = 0;"
			);
			$sql ->bindParam(":usuario",$usuario,PDO::PARAM_STR);
			$sql ->bindParam(":contrasena",$contrasena,PDO::PARAM_STR);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar usuario que inició sesión en el sistema desde la base de datos.
		static public function seleccionarUsuarioSesionBD($usuarioSesion){
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.nombre, u.tipo, u_a.iduser, u_a.usuario, u_a.status 
				FROM user u INNER JOIN user_acceso u_a ON u_a.iduser = u.iduser WHERE u.iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $usuarioSesion, PDO::PARAM_STR);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Recuperar datos de usuario de la base de datos.
		static public function datosUsuarioBD($usuarioId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT iduser, nombre, tipo, fecha, 
				date_format(fecha, '%d de %M de %Y') fecha 
				FROM user 
				WHERE tipo > 0 AND tipo < 4 AND status = 1 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $usuarioId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar todos los usuarios de tipo médico.
		static public function medicosBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT iduser, nombre FROM user 
				WHERE tipo = 3 AND status = 1;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Actualizar datos de usuario en la base de datos.
		static public function actualizarUsuarioBD($datosUsuario){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user SET nombre = :nombre, tipo = :tipo WHERE iduser = :iduser;"
			);
			$sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
			$sql -> bindParam(":iduser", $datosUsuario["iduser"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Actualizar contraseña de usuario en la base de datos.
		static public function actualizarPicBD($datosPic){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_acceso SET contrasena = :contrasena WHERE iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $datosPic["usuarioId"], PDO::PARAM_INT);
			$sql -> bindParam(":contrasena", $datosPic["contrasenaNew"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Verificar la contraseña de usuario en la base de datos.
		static public function verificarPicOldBD($datosPic){
			$sql = Conexion::conectar() -> prepare(
				"SELECT contrasena FROM user_acceso WHERE iduser = :iduser AND contrasena = :contrasena;"
			);
			$sql -> bindParam(":iduser", $datosPic["usuarioId"], PDO::PARAM_INT);
			$sql -> bindParam(":contrasena", $datosPic["contrasenaOld"], PDO::PARAM_STR);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Cambiar a desconectado el status del usuario hacia la base de datos.
		static public function desconectarUsuarioBD($usuario){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_acceso SET status = 0 WHERE iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $usuario, PDO::PARAM_STR);
			if ($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Cambiar a conectado el status del usuario hacia la base de datos.
		static public function conectarUsuarioBD($usuario){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_acceso SET status = 1 WHERE iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $usuario, PDO::PARAM_STR);
			if ($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Crear cuenta de usuario en la base de datos.
		static public function crearCuentaBD($datosUsuario){
			$transaccion = true;
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO user(nombre, fecha, tipo, status) VALUE(:nombre, now(), :tipo, 2);"
			);
			$sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
			if ($sql -> execute()) {
				$transaccion = true;
			}else{
				return false;
				$sql = null;
			}

			if ($transaccion) {
				$sql2 = Conexion::conectar() -> prepare(
					"select iduser from user where nombre = :nombre AND tipo = :tipo AND status = 2;"
				);
				$sql2 -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
				$sql2 -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
				$sql2 -> execute();
				$usuario = $sql2 -> fetch();
				$crearAcceso = CRUDUsuario::crearAccesoUsuarioBD($usuario, $datosUsuario);
				if ($crearAcceso) {
					$sql3 = Conexion::conectar() -> prepare(
						"UPDATE user set status = 1 where iduser = :iduser AND status = 2;"
					);
					$sql3 -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
					if ($sql3 -> execute()) {
						return true;
					}else{
						return false;
					}
				}
			}
			$sql = null;
			$sql2 = null;
			$sql3 = null;
		}

		#Crear acceso de usuario en la base de datos.
		static public function crearAccesoUsuarioBD($usuario, $datosAcceso){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO user_acceso(iduser, usuario, contrasena, fecha, status) 
				VALUE(:iduser, :usuario, :contrasena, now(), 0);"
			);
			$sql -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
			$sql -> bindParam(":usuario", $datosAcceso["usuario"], PDO::PARAM_STR);
			$sql -> bindParam(":contrasena", $datosAcceso["contrasena"], PDO::PARAM_STR);
			if($sql -> execute()){
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Deshabilitar uno o más usuarios del sistema.
		static public function eliminarUsuariosBD($usuarioId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user SET status = 0 WHERE tipo != 1 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $usuarioId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return $usuarioId;
			}else{
				return false;
			}
			$sql = null;
		}
	}
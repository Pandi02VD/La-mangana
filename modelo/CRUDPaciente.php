<?php
	class CRUDPaciente{
		#Seleccionar el último registro de pacientes.
		static public function ultimoPacienteBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT MAX(idUsuario) AS idUsuario FROM usuario WHERE tipoUsuario = 0;"
			);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Buscar pacientes en la base de datos.
		static public function buscarPacientesBD($buscar){
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
		
		#Seleccionar pacientes de la base de datos.
		static public function selPacientesBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT idUsuario, nombre, apellidos, tipoUsuario, 
				date_format(fechaRegistro, '%d/%b/%Y') fechaRegistro 
				FROM usuario WHERE estado = 1 AND tipoUsuario = 0;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar la información del paciente de la base de datos.
		static public function selInfoPacienteBD($idPaciente){
			$sql = Conexion::conectar() -> prepare(
				"SELECT *, date_format(fechaRegistro, '%d/%b/%Y') fechaRegistro 
				FROM usuario 
				WHERE estado = 1 AND tipoUsuario = 0 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idPaciente, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar la información del paciente de la base de datos.
		static public function selAtributosBD($idPaciente){
			$sql = Conexion::conectar() -> prepare(
				"SELECT *, date_format(fechaNacimiento, '%Y-%m-%d') fechaNacimiento 
				FROM paciente_atributos 
				WHERE estado = 1 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idPaciente, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar la información del paciente de la base de datos.
		static public function hayAtributosBD($idPaciente){
			$sql = Conexion::conectar() -> prepare(
				"SELECT COUNT(*) AS attr FROM paciente_atributos 
				WHERE estado = 1 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idPaciente, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Crear los atributos del paciente en la base de datos.
		static public function nuevosAtributosBD($idPaciente, $attr){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO paciente_atributos(idUsuario, sexo, estadoCivil, fechaNacimiento, ocupacion, estado)
				VALUE(:idUsuario, :sexo, :estadoCivil, :fechaNacimiento, :ocupacion, 1);"
			);
			$sql -> bindParam(":idUsuario", $idPaciente, PDO::PARAM_INT);
			$sql -> bindParam(":sexo", $attr["sexo"], PDO::PARAM_INT);
			$sql -> bindParam(":estadoCivil", $attr["edoCivil"], PDO::PARAM_INT);
			$sql -> bindParam(":fechaNacimiento", $attr["fecha"]);
			$sql -> bindParam(":ocupacion", $attr["ocupacion"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Actualizar los atributos del paciente en la base de datos.
		static public function actualizarAtributosBD($idPaciente, $attr){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE paciente_atributos 
				SET sexo = :sexo, estadoCivil = :estadoCivil, 
				fechaNacimiento = :fechaNacimiento, ocupacion = :ocupacion, estado = 1
				WHERE estado = 1 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idPaciente, PDO::PARAM_INT);
			$sql -> bindParam(":sexo", $attr["sexo"], PDO::PARAM_INT);
			$sql -> bindParam(":estadoCivil", $attr["edoCivil"], PDO::PARAM_INT);
			$sql -> bindParam(":fechaNacimiento", $attr["fecha"]);
			$sql -> bindParam(":ocupacion", $attr["ocupacion"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Contar pacientes de la base de datos.
		static public function contarPacientesBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as totalPacientes FROM usuario 
				WHERE estado = 1 AND tipoUsuario = 0;"
			);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar pacientes de la base de datos.
		static public function existePacienteBD($idUsuario){
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

		#Crear nuevo paciente.
		static public function nuevoPacienteBD($datosPaciente){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO usuario(nombre, apellidos, fechaRegistro, tipoUsuario, estado) 
				VALUE(:nombre, :apellidos, now(), 0, 1);"
			);
			$sql -> bindParam(":nombre", $datosPaciente["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":apellidos", $datosPaciente["apellidos"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		#Confirmar los datos de un usuario al iniciar sesión
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
		static public function desconectarPacienteBD($idUsuario){
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
		static public function conectarPacienteBD($usuario){
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
		static public function datosPacienteBD($idUsuario){
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
		static public function actualizarPacienteBD($datosPaciente){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario 
				SET nombre = :nombre, apellidos = :apellidos 
				WHERE idUsuario = :idUsuario AND tipoUsuario = 0;"
			);
			$sql -> bindParam(":nombre", $datosPaciente["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":apellidos", $datosPaciente["apellidos"], PDO::PARAM_STR);
			$sql -> bindParam(":idUsuario", $datosPaciente["idPaciente"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		// #Actualizar contraseña de usuario en la base de datos.
		// static public function actualizarPicBD($datosPic){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE usuario_acceso SET contrasena = :contrasena WHERE idUsuario = :idUsuario;"
		// 	);
		// 	$sql -> bindParam(":idUsuario", $datosPic["usuarioId"], PDO::PARAM_INT);
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
		// static public function verificarPicOldBD($datosPic){
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT contrasena FROM usuario_acceso WHERE idUsuario = :idUsuario AND contrasena = :contrasena;"
		// 	);
		// 	$sql -> bindParam(":idUsuario", $datosPic["usuarioId"], PDO::PARAM_INT);
		// 	$sql -> bindParam(":contrasena", $datosPic["contrasenaOld"], PDO::PARAM_STR);
		// 	$sql -> execute();
		// 	return $sql -> fetch();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		#Validar usuario en la base de datos.
		static public function validarPacienteBD($usuario){
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
				$crearAcceso = CRUDUsuario::crearAccesoPacienteBD($usuario, $datosUsuario);
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
		static public function crearAccesoPacienteBD($usuario, $datosAcceso){
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
		static public function eliminarPacientesBD($idUsuario){
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
	}
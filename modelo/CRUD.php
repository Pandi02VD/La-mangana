<?php
	require_once 'Conexion.php'; 
	class CRUD extends Conexion{
		#Seleccionar correo electrónico del paciente o usuario de la base de datos.
		static public function selCorreoBD($idCorreo){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM usuario_correo 
				WHERE estado >= 1 AND estado <=2 AND idUsuarioCorreo = :idUsuarioCorreo;"
			);
			$sql -> bindParam(":idUsuarioCorreo", $idCorreo, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar teléfono del paciente o usuario de la base de datos.
		static public function selTelefonoBD($idTelefono){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM usuario_telefono 
				WHERE estado >= 1 AND estado <=2 AND idUsuarioTelefono = :idUsuarioTelefono;"
			);
			$sql -> bindParam(":idUsuarioTelefono", $idTelefono, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar domicilio del paciente o usuario de la base de datos.
		static public function selDomicilioBD($idDomicilio){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM usuario_domicilio 
				WHERE estado >= 1 AND estado <=2 AND idUsuarioDomicilio = :idUsuarioDomicilio;"
			);
			$sql -> bindParam(":idUsuarioDomicilio", $idDomicilio, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Seleccionar correos electrónicos del paciente o usuario de la base de datos.
		static public function selCorreosBD($idPersona){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM usuario_correo 
				WHERE estado >= 1 AND estado <=2 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql -> close();
			$sql = null;
		}

		#Seleccionar teléfonos del paciente o usuario de la base de datos.
		static public function selTelefonosBD($idPersona){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM usuario_telefono 
				WHERE estado >= 1 AND estado <=2 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql -> close();
			$sql = null;
		}
		
		#Seleccionar domicilios del paciente o usuario de la base de datos.
		static public function selDomiciliosBD($idPersona){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM usuario_domicilio 
				WHERE estado >= 1 AND estado <=2 AND idUsuario = :idUsuario;"
			);
			$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql -> close();
			$sql = null;
		}

		#Verificacion del primer correo de la tabla.
		static public function hayCorreosBD($idPersona){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as correos FROM usuario_correo 
				WHERE idUsuario = :idUsuario AND estado >= 1;"
			);
			$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Verificacion del primer telefono de la tabla.
		static public function hayTelefonosBD($idPersona){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as telefonos FROM usuario_telefono 
				WHERE idUsuario = :idUsuario AND estado >= 1;"
			);
			$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}

		#Verificacion del primer domicilio de la tabla.
		static public function hayDomiciliosBD($idPersona){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as domicilios FROM usuario_domicilio 
				WHERE idUsuario = :idUsuario AND estado >= 1;"
			);
			$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql -> close();
			$sql = null;
		}
		
		#Agregar nuevo correo electrónico en la base de datos.
		static public function nuevoCorreoBD($datosCorreo, $estado){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO usuario_correo(idUsuario, correo, fechaRegistro, estado) 
				VALUE(:idUsuario, :correo, now(), :estado);"
			);
			$sql -> bindParam(":idUsuario", $datosCorreo["idPersona"], PDO::PARAM_INT);
			$sql -> bindParam(":correo", $datosCorreo["correo"], PDO::PARAM_STR);
			$sql -> bindParam(":estado", $estado, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Agregar nuevo teléfono en la base de datos.
		static public function nuevoTelefonoBD($datosTelefono, $estado){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO usuario_telefono(idUsuario, tipoTelefono, numero, fechaRegistro, estado) 
				VALUE(:idUsuario, :tipoTelefono, :numero, now(), :estado);"
			);
			$sql -> bindParam(":idUsuario", $datosTelefono["idPersona"], PDO::PARAM_INT);
			$sql -> bindParam(":numero", $datosTelefono["telefono"], PDO::PARAM_STR);
			$sql -> bindParam(":tipoTelefono", $datosTelefono["tipo"], PDO::PARAM_INT);
			$sql -> bindParam(":estado", $estado, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Agregar nuevo domicilio en la base de datos.
		static public function nuevoDomicilioBD($idPersona, $domicilioJSON, $estado){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO usuario_domicilio(
					idUsuario, domicilioJSON, fechaRegistro, estado
				) 
				VALUE(
					:idUsuario, :domicilioJSON, now(), :estado
				);"
			);

			$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
			$sql -> bindParam(":domicilioJSON", $domicilioJSON);
			$sql -> bindParam(":estado", $estado, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		#Actualizar el correo electrónico en la base de datos.
		static public function actualizarCorreoBD($datosCorreo){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_correo SET correo = :correo 
				WHERE idUsuarioCorreo = :idUsuarioCorreo;"
			);
			$sql -> bindParam(":idUsuarioCorreo", $datosCorreo["correoId"], PDO::PARAM_INT);
			$sql -> bindParam(":correo", $datosCorreo["correo"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Actualizar el teléfono en la base de datos.
		static public function actualizarTelefonoBD($datosTelefono){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_telefono 
				SET numero = :numero, tipoTelefono = :tipoTelefono 
				WHERE idUsuarioTelefono = :idUsuarioTelefono;"
			);
			$sql -> bindParam(":numero", $datosTelefono["numero"], PDO::PARAM_STR);
			$sql -> bindParam(":tipoTelefono", $datosTelefono["tipo"], PDO::PARAM_INT);
			$sql -> bindParam(":idUsuarioTelefono", $datosTelefono["idTelefono"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Actualizar el domicilio en la base de datos.
		static public function actualizarDomicilioBD($idDomicilio, $domicilioJSON){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_domicilio SET 
				domicilioJSON = :domicilioJSON 
				WHERE idUsuarioDomicilio = :idUsuarioDomicilio;"
			);
			$sql -> bindParam(":idUsuarioDomicilio", $idDomicilio, PDO::PARAM_INT);
			$sql -> bindParam(":domicilioJSON", $domicilioJSON);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Deshabilitar un correo electrónico.
		static public function eliminarCorreoBD($idCorreo){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_correo SET estado = 0 
				WHERE idUsuarioCorreo = :idUsuarioCorreo;"
			);
			$sql -> bindParam(":idUsuarioCorreo", $idCorreo, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Deshabilitar un teléfono.
		static public function eliminarTelefonoBD($idTelefono){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_telefono SET estado = 0 
				WHERE idUsuarioTelefono = :idUsuarioTelefono;"
			);
			$sql -> bindParam(":idUsuarioTelefono", $idTelefono, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}
		
		#Deshabilitar un domicilio.
		static public function eliminarDomicilioBD($idDomicilio){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE usuario_domicilio SET estado = 0 
				WHERE idUsuarioDomicilio = :idUsuarioDomicilio;"
			);
			$sql -> bindParam(":idUsuarioDomicilio", $idDomicilio, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql -> close();
			$sql = null;
		}

		// #Establecer correo electrónico como principal
		// static public function correoPrincipalBD($correoId) {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE user_correo SET estado = 2 WHERE idUsuario_correo = :idUsuario_correo;"
		// 	);
		// 	$sql -> bindParam(":idUsuario_correo", $correoId, PDO::PARAM_INT);
		// 	if($sql -> execute()){
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Establecer teléfono como principal
		// static public function telefonoPrincipalBD($telefonoId) {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE user_telefono SET estado = 2 WHERE idUsuario_telefono = :idUsuario_telefono;"
		// 	);
		// 	$sql -> bindParam(":idUsuario_telefono", $telefonoId, PDO::PARAM_INT);
		// 	if($sql -> execute()){
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Establecer domicilio como principal
		// static public function domicilioPrincipalBD($domicilioId) {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE user_domicilio SET estado = 2 WHERE idUsuario_domicilio = :idUsuario_domicilio;"
		// 	);
		// 	$sql -> bindParam(":idUsuario_domicilio", $domicilioId, PDO::PARAM_INT);
		// 	if($sql -> execute()){
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Establecer como no principales todos los elementos de información de un cliente o usuario.
		// static public function disMainElementBD($Id, $tabla) {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"UPDATE $tabla SET estado = 1 
		// 		WHERE idUsuario = :idUsuario AND estado >= 1 AND estado <= 2;"
		// 	);
		// 	$sql -> bindParam(":idUsuario", $Id, PDO::PARAM_INT);
		// 	if($sql -> execute()) {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Establecer correo electrónico como principal.
		// static public function asMainElementBD($elementId, $tabla) {
		// 	$strSQL;
		// 	$Id;
		// 	if ($tabla == "user_correo") {
		// 		$Id = CRUD::seleccionarCorreoBD($elementId);
		// 		$strSQL = "UPDATE $tabla SET estado = 2 WHERE idUsuario_correo = :idelement;";
		// 	} elseif ($tabla == "user_telefono") {
		// 		$Id = CRUD::seleccionarTelefonoBD($elementId);
		// 		$strSQL = "UPDATE $tabla SET estado = 2 WHERE idUsuario_telefono = :idelement;";
		// 	} elseif ($tabla == "user_domicilio") {
		// 		$Id = CRUD::seleccionarDomicilioBD($elementId);
		// 		$strSQL = "UPDATE $tabla SET estado = 2 WHERE idUsuario_domicilio = :idelement;";
		// 	}
			
		// 	CRUD::disMainElementBD($Id["idUsuario"], $tabla);
		// 	$sql = Conexion::conectar() -> prepare($strSQL);
		// 	$sql -> bindParam(":idelement", $elementId, PDO::PARAM_INT);
		// 	if($sql -> execute()) {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Seleccionar correo electrónico principal.
		// static public function selCorreoPrincipalBD($idPersona) {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT correo FROM user_correo 
		// 		WHERE idUsuario = :idUsuario AND estado = 2;"
		// 	);
		// 	$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
		// 	$sql -> execute();
		// 	return $sql -> fetch();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Seleccionar teléfono principal.
		// static public function selTelefonoPrincipalBD($idPersona) {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT numero, tipo FROM user_telefono 
		// 		WHERE idUsuario = :idUsuario AND estado = 2;"
		// 	);
		// 	$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
		// 	$sql -> execute();
		// 	return $sql -> fetch();
		// 	$sql -> close();
		// 	$sql = null;
		// }

		// #Seleccionar domicilio principal.
		// static public function selDomicilioPrincipalBD($idPersona) {
		// 	$sql = Conexion::conectar() -> prepare(
		// 		"SELECT calle, num_casaint, colonia FROM user_domicilio 
		// 		WHERE idUsuario = :idUsuario AND estado = 2;"
		// 	);
		// 	$sql -> bindParam(":idUsuario", $idPersona, PDO::PARAM_INT);
		// 	$sql -> execute();
		// 	return $sql -> fetch();
		// 	$sql -> close();
		// 	$sql = null;
		// }
	}
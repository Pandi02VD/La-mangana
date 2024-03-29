<?php
	require_once 'Conexion.php'; 
	class CRUD extends Conexion{
		#Seleccionar correo electrónico del cliente o usuario de la base de datos.
		static public function seleccionarCorreoBD($correoId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM user_correo 
				WHERE status >= 1 AND status <=2 AND iduser_correo = :iduser_correo;"
			);
			$sql -> bindParam(":iduser_correo", $correoId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar teléfono del cliente o usuario de la base de datos.
		static public function seleccionarTelefonoBD($telefonoId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM user_telefono 
				WHERE status >= 1 AND status <=2 AND iduser_telefono = :iduser_telefono;"
			);
			$sql -> bindParam(":iduser_telefono", $telefonoId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Seleccionar domicilio del cliente o usuario de la base de datos.
		static public function seleccionarDomicilioBD($domicilioId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM user_domicilio 
				WHERE status >= 1 AND status <=2 AND iduser_domicilio = :iduser_domicilio;"
			);
			$sql -> bindParam(":iduser_domicilio", $domicilioId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar correos electrónicos del cliente o usuario de la base de datos.
		static public function seleccionarCorreosBD($personaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM user_correo 
				WHERE status >= 1 AND status <=2 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $personaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Seleccionar teléfonos del cliente o usuario de la base de datos.
		static public function seleccionarTelefonosBD($personaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM user_telefono 
				WHERE status >= 1 AND status <=2 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $personaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Seleccionar domicilios del cliente o usuario de la base de datos.
		static public function seleccionarDomiciliosBD($personaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT iduser_domicilio, colonia, calle, num_casaex, status 
				FROM user_domicilio 
				WHERE status >= 1 AND status <=2 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $personaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Verificacion del primer correo de la tabla.
		static public function hayCorreosBD($userId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as correos FROM user_correo 
				WHERE iduser = :iduser AND status >= 1;"
			);
			$sql -> bindParam(":iduser", $userId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Verificacion del primer telefono de la tabla.
		static public function hayTelefonosBD($userId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as telefonos FROM user_telefono 
				WHERE iduser = :iduser AND status >= 1;"
			);
			$sql -> bindParam(":iduser", $userId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Verificacion del primer domicilio de la tabla.
		static public function hayDomiciliosBD($userId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as domicilios FROM user_domicilio 
				WHERE iduser = :iduser AND status >= 1;"
			);
			$sql -> bindParam(":iduser", $userId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Agregar nuevo correo electrónico en la base de datos.
		static public function nuevoCorreoBD($datosCorreoPersona, $status){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO user_correo(iduser, correo, status) 
				VALUE(:iduser, :correo, :status);"
			);
			$sql -> bindParam(":iduser", $datosCorreoPersona["personaId"], PDO::PARAM_INT);
			$sql -> bindParam(":correo", $datosCorreoPersona["correo"], PDO::PARAM_STR);
			$sql -> bindParam(":status", $status, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Agregar nuevo teléfono en la base de datos.
		static public function nuevoTelefonoBD($datosTelefonoPersona, $status){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO user_telefono(iduser, tipo, numero, status) 
				VALUE(:iduser, :tipo, :numero, :status);"
			);
			$sql -> bindParam(":iduser", $datosTelefonoPersona["personaId"], PDO::PARAM_INT);
			$sql -> bindParam(":numero", $datosTelefonoPersona["telefono"], PDO::PARAM_STR);
			$sql -> bindParam(":tipo", $datosTelefonoPersona["tipo"], PDO::PARAM_INT);
			$sql -> bindParam(":status", $status, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Agregar nuevo domicilio en la base de datos.
		static public function nuevoDomicilioBD($datosDomicilioPersona, $status){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO user_domicilio(
					iduser, estado, localidad, colonia, calle, num_casaex, 
					num_casaint, calle1, calle2, referencia, status
				) 
				VALUE(
					:iduser, :estado, :localidad, :colonia, :calle, :num_casaex, 
					:num_casaint, :calle1, :calle2, :referencia, :status
				);"
			);

			$sql -> bindParam(":iduser", $datosDomicilioPersona["personaId"], PDO::PARAM_INT);
			$sql -> bindParam(":estado", $datosDomicilioPersona["estado"], PDO::PARAM_STR);
			$sql -> bindParam(":localidad", $datosDomicilioPersona["municipio"], PDO::PARAM_STR);
			$sql -> bindParam(":colonia", $datosDomicilioPersona["colonia"], PDO::PARAM_STR);
			$sql -> bindParam(":calle", $datosDomicilioPersona["calle"], PDO::PARAM_STR);
			$sql -> bindParam(":num_casaex", $datosDomicilioPersona["numeroE"], PDO::PARAM_INT);
			$sql -> bindParam(":num_casaint", $datosDomicilioPersona["numeroI"], PDO::PARAM_INT);
			$sql -> bindParam(":calle1", $datosDomicilioPersona["calle1"], PDO::PARAM_STR);
			$sql -> bindParam(":calle2", $datosDomicilioPersona["calle2"], PDO::PARAM_STR);
			$sql -> bindParam(":referencia", $datosDomicilioPersona["referencia"], PDO::PARAM_STR);
			$sql -> bindParam(":status", $status, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Actualizar el correo electrónico en la base de datos.
		static public function actualizarCorreoBD($datosCorreoPersona){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_correo SET correo = :correo WHERE iduser_correo = :iduser_correo;"
			);
			$sql -> bindParam(":iduser_correo", $datosCorreoPersona["correoId"], PDO::PARAM_INT);
			$sql -> bindParam(":correo", $datosCorreoPersona["correo"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Actualizar el teléfono en la base de datos.
		static public function actualizarTelefonoBD($datosTelefonoPersona){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_telefono SET numero = :numero, tipo = :tipo WHERE iduser_telefono = :iduser_telefono;"
			);
			$sql -> bindParam(":numero", $datosTelefonoPersona["numero"], PDO::PARAM_STR);
			$sql -> bindParam(":tipo", $datosTelefonoPersona["tipo"], PDO::PARAM_INT);
			$sql -> bindParam(":iduser_telefono", $datosTelefonoPersona["telefonoId"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Actualizar el domicilio en la base de datos.
		static public function actualizarDomicilioBD($datosDomicilioPersona){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_domicilio SET 
					estado = :estado, 
					localidad = :localidad, 
					colonia = :colonia, 
					calle = :calle, 
					num_casaex = :num_casaex, 
					num_casaint = :num_casaint, 
					calle1 = :calle1, 
					calle2 = :calle2, 
					referencia = :referencia 
				WHERE iduser_domicilio = :iduser_domicilio;"
			);
			$sql -> bindParam(":iduser_domicilio", $datosDomicilioPersona["domicilioId"], PDO::PARAM_INT);
			$sql -> bindParam(":estado", $datosDomicilioPersona["estado"], PDO::PARAM_STR);
			$sql -> bindParam(":localidad", $datosDomicilioPersona["municipio"], PDO::PARAM_STR);
			$sql -> bindParam(":colonia", $datosDomicilioPersona["colonia"], PDO::PARAM_STR);
			$sql -> bindParam(":calle", $datosDomicilioPersona["calle"], PDO::PARAM_STR);
			$sql -> bindParam(":num_casaex", $datosDomicilioPersona["numeroE"], PDO::PARAM_INT);
			$sql -> bindParam(":num_casaint", $datosDomicilioPersona["numeroI"], PDO::PARAM_INT);
			$sql -> bindParam(":calle1", $datosDomicilioPersona["calle1"], PDO::PARAM_STR);
			$sql -> bindParam(":calle2", $datosDomicilioPersona["calle2"], PDO::PARAM_STR);
			$sql -> bindParam(":referencia", $datosDomicilioPersona["referencia"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Deshabilitar uno o más correos electrónicos de clientes o usuarios en la base de datos.
		static public function eliminarCorreoBD($correoId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_correo SET status = 0 WHERE iduser_correo = :iduser_correo;"
			);
			$sql -> bindParam(":iduser_correo", $correoId, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Deshabilitar uno o más teléfonos de clientes o usuarios del sistema.
		static public function eliminarTelefonoBD($telefonoId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_telefono set status = 0 WHERE iduser_telefono = :iduser_telefono;"
			);
			$sql -> bindParam(":iduser_telefono", $telefonoId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Deshabilitar uno o más domicilios de clientes del sistema.
		static public function eliminarDomicilioBD($domicilioId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_domicilio set status = 0 WHERE iduser_domicilio = :iduser_domicilio;"
			);
			$sql -> bindParam(":iduser_domicilio", $domicilioId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Establecer correo electrónico como principal
		static public function correoPrincipalBD($correoId) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_correo SET status = 2 WHERE iduser_correo = :iduser_correo;"
			);
			$sql -> bindParam(":iduser_correo", $correoId, PDO::PARAM_INT);
			if($sql -> execute()){
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Establecer teléfono como principal
		static public function telefonoPrincipalBD($telefonoId) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_telefono SET status = 2 WHERE iduser_telefono = :iduser_telefono;"
			);
			$sql -> bindParam(":iduser_telefono", $telefonoId, PDO::PARAM_INT);
			if($sql -> execute()){
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Establecer domicilio como principal
		static public function domicilioPrincipalBD($domicilioId) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user_domicilio SET status = 2 WHERE iduser_domicilio = :iduser_domicilio;"
			);
			$sql -> bindParam(":iduser_domicilio", $domicilioId, PDO::PARAM_INT);
			if($sql -> execute()){
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Establecer como no principales todos los elementos de información de un cliente o usuario.
		static public function disMainElementBD($Id, $tabla) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE $tabla SET status = 1 
				WHERE iduser = :iduser AND status >= 1 AND status <= 2;"
			);
			$sql -> bindParam(":iduser", $Id, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Establecer correo electrónico como principal.
		static public function asMainElementBD($elementId, $tabla) {
			$strSQL = null;
			$Id = null;
			if ($tabla == "user_correo") {
				$Id = CRUD::seleccionarCorreoBD($elementId);
				$strSQL = "UPDATE $tabla SET status = 2 WHERE iduser_correo = :idelement;";
			} elseif ($tabla == "user_telefono") {
				$Id = CRUD::seleccionarTelefonoBD($elementId);
				$strSQL = "UPDATE $tabla SET status = 2 WHERE iduser_telefono = :idelement;";
			} elseif ($tabla == "user_domicilio") {
				$Id = CRUD::seleccionarDomicilioBD($elementId);
				$strSQL = "UPDATE $tabla SET status = 2 WHERE iduser_domicilio = :idelement;";
			}
			
			CRUD::disMainElementBD($Id["iduser"], $tabla);
			$sql = Conexion::conectar() -> prepare($strSQL);
			$sql -> bindParam(":idelement", $elementId, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Seleccionar correo electrónico principal.
		static public function seleccionarCorreoPrincipalBD($personaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT correo FROM user_correo 
				WHERE iduser = :iduser AND status = 2;"
			);
			$sql -> bindParam(":iduser", $personaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar teléfono principal.
		static public function seleccionarTelefonoPrincipalBD($personaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT numero, tipo FROM user_telefono 
				WHERE iduser = :iduser AND status = 2;"
			);
			$sql -> bindParam(":iduser", $personaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar domicilio principal.
		static public function seleccionarDomicilioPrincipalBD($personaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT calle, num_casaint, colonia FROM user_domicilio 
				WHERE iduser = :iduser AND status = 2;"
			);
			$sql -> bindParam(":iduser", $personaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
	}
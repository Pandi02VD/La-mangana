<?php
	class CRUDCliente{
		#Buscar cliente en la base de datos.
		static public function buscarClienteBD($search){
			$respuestas = array();
			$sql = Conexion::conectar() -> prepare(
				"SELECT *, date_format(fecha, '%d/%M/%Y') fecha FROM user 
				WHERE nombre LIKE '%$search%' AND status = 1 AND tipo = 0;"
			);
			$sql -> execute();
			$cliente = $sql -> fetchAll();
			if (sizeof($cliente) > 0) {
				for ($i = 0; $i < sizeof($cliente); $i++) {
					$mascotasVinculadas = CRUDCliente::contarMascotasClienteBD($cliente[$i]["iduser"]);
					$respuestas[$i] = array_merge($cliente[$i], $mascotasVinculadas);
				}
				return $respuestas;
			} else {
				return null;
			}
			$sql = null;
		}
		
		#Seleccionar clientes de la base de datos.
		static public function seleccionarClientesBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT u.iduser, u.nombre, u.tipo, u.fecha, 
				date_format(u.fecha, '%d/%M/%Y') fecha 
				FROM user u WHERE u.status = 1 AND u.tipo = 0 
				ORDER BY u.iduser DESC;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Seleccionar cliente de la base de datos.
		static public function seleccionarClienteBD($clienteId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT nombre as cliente FROM user 
				WHERE status = 1 AND tipo = 0 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Recuperar datos de cliente de la base de datos.
		static public function datosClienteBD($clienteId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT iduser, nombre as cliente FROM user 
				WHERE tipo = 0 AND status = 1 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Listar las mascotas del cliente de la base de datos.
		static public function misMascotasBD($clienteId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT idmascota, nombre as mascota FROM mascota 
				WHERE status = 1 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Actualizar datos de cliente en la base de datos.
		static public function actualizarClienteBD($datosCliente){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user SET nombre = :nombre 
				WHERE tipo = 0 AND iduser = :iduser;"
			);
			$sql -> bindParam(":nombre", $datosCliente["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":iduser", $datosCliente["iduser"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Crear cliente en la base de datos.
		static public function crearClienteBD($nombreCliente){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO user(nombre, fecha, tipo, status) 
				VALUE(:nombre, now(), 0, 1);"
			);
			$sql -> bindParam(":nombre", $nombreCliente, PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		#Deshabilitar uno o más clientes del sistema.
		static public function eliminarClientesBD($clienteId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE user set status = 0 WHERE tipo = 0 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return $clienteId;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Contar mascotas del cliente desde la base de datos.
		static public function contarMascotasClienteBD($clienteId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT count(*) as num_mascotas FROM mascota WHERE status = 1 AND iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
	}
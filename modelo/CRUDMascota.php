<?php
	class CRUDMascota{
		#Buscar mascota desde la base de datos.
		static public function buscarMascotaBD($search) {
			$respuestas = array();
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				u.nombre as cliente, m.idmascota, m.nombre as mascota, 
				m.sexo, m.ano_nacimiento, m_r.idmascota_raza 
				FROM mascota m 
				INNER JOIN user u ON m.iduser = u.iduser 
				INNER JOIN mascota_raza m_r ON m.idmascota_raza = m_r.idmascota_raza 
				INNER JOIN mascota_especie m_e ON m_r.idmascota_especie = m_e.idmascota_especie 
				WHERE m.nombre LIKE '%$search%' AND m.status = 1;"
			);
			$sql -> execute();
			$razaId =  $sql  -> fetchAll();
			if (sizeof($razaId) > 0) {
				for ($i = 0; $i < sizeof($razaId); $i++) {
					$raza = CRUDMascota::seleccionarRazaMascotaBD($razaId[$i]["idmascota_raza"]);
					$respuestas[$i] = array_merge($razaId[$i], $raza);
				}
				return $respuestas;
			} else {
				return null;
			}
			$sql = null;
		}
		
		#Buscar mascota por cliente desde la base de datos.
		static public function buscarMascotaClienteBD($search, $clienteId) {
			$respuestas = array();
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				m.idmascota, m.nombre as mascota, 
				m.sexo, m.ano_nacimiento, m_r.idmascota_raza 
				FROM mascota m 
				INNER JOIN user u ON m.iduser = u.iduser 
				INNER JOIN mascota_raza m_r ON m.idmascota_raza = m_r.idmascota_raza 
				INNER JOIN mascota_especie m_e ON m_r.idmascota_especie = m_e.idmascota_especie 
				WHERE m.nombre LIKE '%$search%' AND m.iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			$sql -> execute();
			$razaId =  $sql  -> fetchAll();
			if (sizeof($razaId) > 0) {
				for ($i = 0; $i < sizeof($razaId); $i++) {
					$raza = CRUDMascota::seleccionarRazaMascotaBD($razaId[$i]["idmascota_raza"]);
					$respuestas[$i] = array_merge($razaId[$i], $raza);
				}
				return $respuestas;
			} else {
				return null;
			}
			$sql = null;
		}
		
		#Buscar raza desde la base de datos.
		static public function buscarRazaBD($search) {
			$respuestas = array();
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM mascota_raza 
				WHERE raza LIKE '%$search%' AND status = 1;"
			);
			$sql -> execute();
			$raza =  $sql  -> fetchAll();
			if (sizeof($raza) > 0) {
				for ($i = 0; $i < sizeof($raza); $i++) {
					$especie = CRUDMascota::seleccionarEspecieByRazaBD($raza[$i]["idmascota_especie"]);
					$respuestas[$i] = array_merge($raza[$i], $especie);
				}
				return $respuestas;
			} else {
				return null;
			}
			$sql = null;
		}
		
		#Buscar jaula de mascota desde la base de datos.
		static public function buscarJaulaBD($search) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM jaula WHERE jaula LIKE '%$search%' AND status >= 1;"
			);
			$sql -> execute();
			return $sql  -> fetchAll();
			$sql = null;
		}

		#Obtener el último registro insertado en una tabla por id.
		static public function lastIdFrom($tabla, $campo){
			$sql = Conexion::conectar() -> prepare(
				"SELECT max($campo) as id from $tabla;"
			);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Recuperar datos de una mascota de la base de datos.
		static public function datosMascotaBD($mascotaId) {
			$infoMascota = CRUDMascota::infoMascota($mascotaId);
			$atributos = CRUDMascota::atributosMascota($mascotaId);
			$infoDueno = CRUDMascota::infoDueno($infoMascota["iduser"]);
			$atributos != null ? $mascota = array_merge($infoMascota, $atributos) : $mascota = $infoMascota;
			return array_merge($mascota, $infoDueno);
		}

		#Recuperar información de una mascota.
		static public function infoMascota($mascotaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
					m.nombre as mascota, m.sexo, m.ano_nacimiento, m.iduser, 
					mr.raza, mr.idmascota_raza, me.especie, me.idmascota_especie
				FROM mascota m 
				INNER JOIN mascota_raza mr ON mr.idmascota_raza = m.idmascota_raza 
				INNER JOIN mascota_especie me ON me.idmascota_especie = mr.idmascota_especie 
				WHERE m.status = 1 AND idmascota = :idmascota;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Recuperar atributos de una mascota.
		static public function atributosMascota($mascotaId) {
			$lastDate = CRUDMascota::ultimosAtributosMascota($mascotaId);
			$sql = Conexion::conectar() -> prepare(
				"SELECT peso, condicion_corporal, tamano 
				FROM mascota_atributos 
				WHERE idmascota = :idmascota AND fecha = :fecha;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> bindParam(":fecha", $lastDate["lastdate"]);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar el último registro de atributos de mascota.
		static public function ultimosAtributosMascota($mascotaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT max(fecha) as lastdate FROM mascota_atributos WHERE idmascota = :idmascota;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Recuperar información del dueño de la mascota.
		static public function infoDueno($clienteId) {
			$correoPrincipal = CRUD::seleccionarCorreoPrincipalBD($clienteId);
			$telefonoPrincipal = CRUD::seleccionarTelefonoPrincipalBD($clienteId);
			$domicilioPrincipal = CRUD::seleccionarDomicilioPrincipalBD($clienteId);
			$sql = Conexion::conectar() -> prepare(
				"SELECT nombre FROM user WHERE iduser = :iduser;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			$sql -> execute();
			$dueno = $sql -> fetch();
			$correoPrincipal != null ? $array1 = array_merge($dueno, $correoPrincipal) : $array1 = $dueno;
			if($telefonoPrincipal != null) {
				$array2 = array_merge($array1, $telefonoPrincipal);
			} else {
				$array2 = $array1;
			}
			if($domicilioPrincipal != null) {
				$array3 = array_merge($array2, $domicilioPrincipal);
			} else {
				$array3 = $array2;
			}
			return $array3;
			$sql = null;
		}
		
		#Agregar nueva mascota de cliente.
		static public function nuevaMascotaBD($datosMascota){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO 
				mascota(
					idmascota_raza, 
					iduser, 
					nombre, 
					sexo, 
					ano_nacimiento, 
					fecha, 
					status
				) VALUE(
					:idmascota_raza, 
					:iduser, 
					:nombre, 
					:sexo, 
					:ano_nacimiento, 
					now(), 
					1
				);"
			);
			$sql -> bindParam(":idmascota_raza", $datosMascota["raza"], PDO::PARAM_INT);
			$sql -> bindParam(":iduser", $datosMascota["propietarioId"], PDO::PARAM_INT);
			$sql -> bindParam(":nombre", $datosMascota["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":sexo", $datosMascota["sexo"], PDO::PARAM_INT);
			$sql -> bindParam(":ano_nacimiento", $datosMascota["edad"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return CRUDMascota::lastIdFrom("mascota", "idmascota");
			} else {
				return false;
			}
			$sql = null;
		}
		
		#Actualizar la información de una mascota de cliente.
		static public function actualizarMascotaBD($datosMascota){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE mascota SET 
					idmascota_raza = :idmascota_raza, 
					iduser = :iduser, 
					nombre = :nombre, 
					sexo = :sexo, 
					ano_nacimiento = :ano_nacimiento
				WHERE idmascota = :idmascota;"
			);
			$sql -> bindParam(":idmascota_raza", $datosMascota["raza"], PDO::PARAM_INT);
			$sql -> bindParam(":iduser", $datosMascota["propietarioId"], PDO::PARAM_INT);
			$sql -> bindParam(":nombre", $datosMascota["nombre"], PDO::PARAM_STR);
			$sql -> bindParam(":sexo", $datosMascota["sexo"], PDO::PARAM_INT);
			$sql -> bindParam(":ano_nacimiento", $datosMascota["edad"], PDO::PARAM_INT);
			$sql -> bindParam(":idmascota", $datosMascota["mascotaId"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}
		
		#Agregar atributos a una mascota en la base de datos.
		static public function nuevosAtributosBD($atributos){
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO mascota_atributos(
					idmascota, 
					peso, 
					tamano, 
					condicion_corporal, 
					fecha, 
					status
				) VALUE(
					:idmascota, 
					:peso, 
					:tamano, 
					:condicion_corporal, 
					now(), 
					1
				);"
			);
			$sql -> bindParam(":idmascota", $atributos["mascotaId"], PDO::PARAM_INT);
			$sql -> bindParam(":peso", $atributos["peso"], PDO::PARAM_STR);
			$sql -> bindParam(":tamano", $atributos["tamano"], PDO::PARAM_INT);
			$sql -> bindParam(":condicion_corporal", $atributos["cuerpo"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Seleccionar pacientes atendidos por día durante el mes.
		static public function resumenBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT DATE_FORMAT(momento, '%Y-%m-%d') AS fecha, 
				DATE(DATE_SUB(NOW(), INTERVAL 7 DAY)) AS inicio, 
				COUNT(momento) AS atendidos 
				FROM consulta 
				WHERE DATE(momento) >= DATE(DATE_SUB(NOW(), INTERVAL 7 DAY))
				AND DATE(momento) <= DATE(NOW())
				GROUP BY fecha;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Seleccionar todos los atributos de una mascota desde la base de datos.
		static public function seleccionarAtributosBD($mascotaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM mascota_atributos WHERE idmascota = :idmascota AND status = 1;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Seleccionar una mascota de la base de datos.
		static public function seleccionarMascotaBD($mascotaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM mascota WHERE status = 1 AND idmascota = :idmascota;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Listar todas las mascotas desde la base de datos.
		static public function listarMascotasBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				u.nombre as cliente, m.idmascota, m.nombre as mascota 
				FROM mascota m 
				INNER JOIN user u ON m.iduser = u.iduser 
				WHERE m.status = 1;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#seleccionar todas las mascotas desde la base de datos.
		static public function seleccionarMascotasBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				u.nombre as cliente, m.idmascota, m.nombre as mascota, 
				m.sexo, m.ano_nacimiento, m_r.idmascota_raza 
				FROM mascota m 
				INNER JOIN user u ON m.iduser = u.iduser 
				INNER JOIN mascota_raza m_r ON m.idmascota_raza = m_r.idmascota_raza 
				INNER JOIN mascota_especie m_e ON m_r.idmascota_especie = m_e.idmascota_especie 
				WHERE m.status = 1;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Mascotas activas (asistieron a consulta en los últimos 3 meses).
		static public function mascotasActivasBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT c.idmascota, m.nombre AS mascota, u.nombre AS prop, c.momento FROM consulta c 
				INNER JOIN mascota m ON m.idmascota = c.idmascota 
				INNER JOIN user u ON u.iduser = m.iduser 
				WHERE c.momento >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
				ORDER BY c.momento DESC LIMIT 3;"
			);

			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Consultas dentro de los últimos 3 meses de mascotas activas.
		static public function ultimasConsultasBD($mascotaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT DATE_FORMAT(momento, '%d-%b') AS momento FROM consulta 
				WHERE momento >= DATE_SUB(NOW(), INTERVAL 3 MONTH) 
				AND idmascota = :idmascota 
				ORDER BY momento DESC;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Mascotas atendidas Hoy.
		static public function mascotasHoyBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT COUNT(*) AS hoy FROM consulta 
				WHERE DATE(momento) = DATE(NOW());"
			);

			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Mascotas atendidas este Mes.
		static public function mascotasMesBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT COUNT(*) AS mes FROM consulta 
				WHERE DATE(momento) >= DATE(CONCAT(YEAR(NOW()), '-', MONTH(NOW()), '-', '01'))
				AND DATE(momento) <= DATE(NOW());"
			);

			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#Mascotas atendidas en Promedio este Mes.
		static public function mascotasPromedioMesBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT COUNT(*) AS promedio, 
				ABS(
					DATEDIFF(
						DATE(CONCAT(YEAR(NOW()), '-', MONTH(NOW()), '-', '01')), DATE(NOW())
					)
				) + 1 AS dias  
				FROM consulta 
				WHERE DATE(momento) >= DATE(CONCAT(YEAR(NOW()), '-', MONTH(NOW()), '-', '01'))
				AND DATE(momento) <= DATE(NOW());"
			);

			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}		
		
		#seleccionar especie por raza de la base de datos.
		static public function seleccionarEspecieByRazaBD($especieId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT especie FROM mascota_especie WHERE idmascota_especie = :idmascota_especie AND status = 1;"
			);
			$sql -> bindParam(":idmascota_especie", $especieId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}
		
		#seleccionar las especies de la base de datos.
		static public function seleccionarEspeciesBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM mascota_especie WHERE status = 1;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Seleccionar datos de raza para editar desde la base de datos.
		static public function seleccionarDatosRazaBD($razaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM mascota_raza WHERE idmascota_raza = :idmascota_raza AND status = 1;"
			);
			$sql -> bindParam(":idmascota_raza", $razaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql  -> fetch();
			$sql = null;
		}
		
		#Agregar nueva jaula en la base de datos.
		static public function nuevaRazaBD($datosRaza) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO mascota_raza(idmascota_especie, raza, status) 
				VALUE(:especieId, :raza, 1);"
			);
			$sql -> bindParam(":especieId", $datosRaza["especieId"], PDO::PARAM_INT);
			$sql -> bindParam(":raza", $datosRaza["raza"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Actualizar raza en la base de datos.
		static public function actualizarRazaBD($datosRaza) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE mascota_raza set idmascota_especie = :idespecie, raza = :raza 
				WHERE idmascota_raza = :idmascota AND status = 1;"
			);
			$sql -> bindParam(":idmascota", $datosRaza["razaId"], PDO::PARAM_INT);
			$sql -> bindParam(":idespecie", $datosRaza["especieId"], PDO::PARAM_INT);
			$sql -> bindParam(":raza", $datosRaza["raza"], PDO::PARAM_STR);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Deshabilitar una o más razas del sistema.
		static public function eliminarRazasBD($razaId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE mascota_raza SET status = 0 WHERE idmascota_raza = :idraza AND status = 1;"
			);
			$sql -> bindParam(":idraza", $razaId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return $razaId;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#seleccionar toas las razas.
		static public function seleccionarRazasBD(){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM mascota_raza WHERE status = 1 ORDER BY raza ASC;"
			);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#seleccionar las razas por especie seleccionada.
		static public function seleccionarRazasByEspecieBD($especieId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM mascota_raza WHERE idmascota_especie = :idmascota_especie AND status = 1;"
			);
			$sql -> bindParam(":idmascota_especie", $especieId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}
		
		#Selecionar información de las mascotas del cliente desde la base de datos.
		static public function mascotasClienteBD($clienteId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT 
				u.nombre as cliente, m.idmascota, m.nombre as mascota, 
				m.sexo, m.ano_nacimiento, m_r.idmascota_raza 
				FROM mascota m 
				INNER JOIN user u ON m.iduser = u.iduser 
				INNER JOIN mascota_raza m_r ON m.idmascota_raza = m_r.idmascota_raza 
				INNER JOIN mascota_especie m_e ON m_r.idmascota_especie = m_e.idmascota_especie 
				WHERE m.iduser = :iduser AND m.status = 1;"
			);
			$sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetchAll();
			$sql = null;
		}

		#Seleccionar raza de mascota desde la base de datos.
		static public function seleccionarRazaMascotaBD($razaId){
			$sql = Conexion::conectar() -> prepare(
				"SELECT raza FROM mascota_raza WHERE idmascota_raza = :idmascota_raza;"
			);
			$sql -> bindParam(":idmascota_raza", $razaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql -> fetch();
			$sql = null;
		}

		#Seleccionar jaula de mascota desde la base de datos.
		static public function seleccionarJaulaBD($jaulaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM jaula WHERE idjaula = :idjaula AND status >= 1;"
			);
			$sql -> bindParam(":idjaula", $jaulaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql  -> fetch();
			$sql = null;
		}
		
		#Seleccionar jaulas de mascotas desde la base de datos.
		static public function seleccionarJaulasBD() {
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM jaula WHERE status >= 1 ORDER BY jaula ASC;"
			);
			$sql -> execute();
			return $sql  -> fetchAll();
			$sql = null;
		}
		
		#Verificar si existe la jaula que se va a agregar en la base de datos.
		static public function existeJaulaBD($jaulaId) {
			$sql = Conexion::conectar() -> prepare(
				"SELECT * FROM jaula WHERE idjaula = :idjaula AND status >= 1;"
			);
			$sql -> bindParam(":idjaula", $jaulaId, PDO::PARAM_INT);
			$sql -> execute();
			return $sql  -> fetch();
			$sql = null;
		}
		
		#Agregar nueva jaula en la base de datos.
		static public function nuevaJaulaBD($jaula) {
			$sql = Conexion::conectar() -> prepare(
				"INSERT INTO jaula(jaula, status) VALUE(:jaula, 1);"
			);
			$sql -> bindParam(":jaula", $jaula, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}
		
		#Actualizar jaula en la base de datos.
		static public function actualizarJaulaBD($datosJaula) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE jaula set jaula = :jaula WHERE idjaula = :idjaula AND status >= 1;"
			);
			$sql -> bindParam(":idjaula", $datosJaula["jaulaId"], PDO::PARAM_INT);
			$sql -> bindParam(":jaula", $datosJaula["jaula"], PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}
		
		#Ocupar jaula en la base de datos.
		static public function ocuparJaulaBD($jaulaId) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE jaula set status = 2 WHERE idjaula = :idjaula;"
			);
			$sql -> bindParam(":idjaula", $jaulaId, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}
		
		#Liberar jaula en la base de datos.
		static public function liberarJaulaBD($jaulaId) {
			$sql = Conexion::conectar() -> prepare(
				"UPDATE jaula set status = 1 WHERE idjaula = :idjaula;"
			);
			$sql -> bindParam(":idjaula", $jaulaId, PDO::PARAM_INT);
			if($sql -> execute()) {
				return true;
			} else {
				return false;
			}
			$sql = null;
		}

		#Deshabilitar una o más jaulas del sistema.
		static public function eliminarJaulasBD($jaulaId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE jaula SET status = 0 WHERE idjaula = :idjaula AND status = 1;"
			);
			$sql -> bindParam(":idjaula", $jaulaId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return $jaulaId;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Deshabilitar una o más consultas del sistema.
		static public function eliminarConsultasBD($consultaId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE consulta SET status = 0 WHERE idconsulta = :idconsulta AND status = 1;"
			);
			$sql -> bindParam(":idconsulta", $consultaId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return $consultaId;
			}else{
				return false;
			}
			$sql = null;
		}
		
		#Deshabilitar una o más mascotas del sistema.
		static public function eliminarMascotasBD($mascotaId){
			$sql = Conexion::conectar() -> prepare(
				"UPDATE mascota SET status = 0 WHERE idmascota = :idmascota AND status = 1;"
			);
			$sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
			if ($sql -> execute()) {
				return $mascotaId;
			}else{
				return false;
			}
			$sql = null;
		}
	}

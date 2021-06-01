<?php
    class CRUDMascota{
        #Obtener el último registro insertado en una tabla por id.
        public function lastIdFrom($tabla, $campo){
            $sql = Conexion::conectar() -> prepare(
                "SELECT max($campo) as id from $tabla;"
            );
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }
        
        #Agregar nueva mascota de cliente.
        public function nuevaMascotaBD($datosMascota){
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
            $sql -> close();
            $sql = null;
        }
        
        #Agregar atributos a una mascota en la base de datos.
        public function nuevosAtributosBD($atributos){
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
            $sql -> close();
            $sql = null;
        }

        #Seleccionar atributos de una mascota desde la base de datos.
        public function seleccionarAtributosBD($mascotaId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT * FROM mascota_atributos WHERE idmascota = :idmascota AND status = 1;"
            );
            $sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }

        #Seleccionar una mascota de la base de datos.
        public function seleccionarMascotaBD($mascotaId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT * FROM mascota WHERE status = 1 AND idmascota = :idmascota;"
            );
            $sql -> bindParam(":idmascota", $mascotaId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }

        #seleccionar todas las mascotas desde la base de datos.
        public function seleccionarMascotasBD(){
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
            $sql -> close();
            $sql = null;
        }
        
        #seleccionar las especies de la base de datos.
        public function seleccionarEspeciesBD(){
            $sql = Conexion::conectar() -> prepare(
                "SELECT * FROM mascota_especie WHERE status = 1;"
            );
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }
        
        #seleccionar las razas por especie seleccionada.
        public function seleccionarRazasByEspecieBD($especieId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT * FROM mascota_raza WHERE idmascota_especie = :idmascota_especie AND status = 1;"
            );
            $sql -> bindParam(":idmascota_especie", $especieId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }
        
        #Selecionar información de las mascotas del cliente desde la base de datos.
        public function mascotasClienteBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT 
                u.nombre as cliente, m.idmascota, m.nombre as mascota, 
                m.sexo, m.ano_nacimiento, m_r.idmascota_raza 
                FROM mascota m 
                INNER JOIN user u ON m.iduser = u.iduser 
                INNER JOIN mascota_raza m_r ON m.idmascota_raza = m_r.idmascota_raza 
                INNER JOIN mascota_especie m_e ON m_r.idmascota_especie = m_e.idmascota_especie 
                WHERE m.iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }

        #Seleccionar raza de mascota desde la base de datos.
        public function seleccionarRazaMascotaBD($razaId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT raza FROM mascota_raza WHERE idmascota_raza = :idmascota_raza;"
            );
            $sql -> bindParam(":idmascota_raza", $razaId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }
    }

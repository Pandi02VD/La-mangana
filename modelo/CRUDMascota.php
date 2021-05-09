<?php
    class CRUDMascota{
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

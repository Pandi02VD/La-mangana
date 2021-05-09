<?php
    class CRUDCliente{
        #Seleccionar clientes de la base de datos.
        public function seleccionarClientesBD(){
            $sql = Conexion::conectar() -> prepare(
                "SELECT u.iduser, u.nombre, u.tipo, u.fecha, 
                date_format(u.fecha, '%d/%M/%Y') fecha FROM user u WHERE u.status = 1 AND u.tipo = 0;"
            );
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }
        
        #Seleccionar cliente de la base de datos.
        public function seleccionarClienteBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT nombre as cliente FROM user 
                WHERE status = 1 AND tipo = 0 AND iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }

        #Seleccionar correo electrónico del cliente de la base de datos.
        public function seleccionarClienteCorreoBD($correoId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT * FROM user_correo 
                WHERE status = 1 AND iduser_correo = :iduser_correo;"
            );
            $sql -> bindParam(":iduser_correo", $correoId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }

        #Seleccionar correos electrónicos del cliente de la base de datos.
        public function seleccionarClienteCorreosBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT * FROM user_correo 
                WHERE status = 1 AND iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }

        #Seleccionar teléfonos del cliente de la base de datos.
        public function seleccionarClienteTelefonosBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT numero, tipo FROM user_telefono 
                WHERE status = 1 AND iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }
        
        #Seleccionar domicilios del cliente de la base de datos.
        public function seleccionarClienteDomiciliosBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT colonia, calle, num_casaex FROM user_domicilio 
                WHERE status = 1 AND iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }

        #Recuperar datos de cliente de la base de datos.
        public function datosClienteBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT iduser, nombre as cliente FROM user 
                WHERE tipo = 0 AND iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }

        #Actualizar datos de cliente en la base de datos.
        public function actualizarClienteBD($datosCliente){
            $sql = Conexion::conectar() -> prepare(
                "UPDATE user set nombre = :nombre 
                WHERE tipo = 0 AND iduser = :iduser;"
            );
            $sql -> bindParam(":nombre", $datosCliente["nombre"], PDO::PARAM_STR);
            $sql -> bindParam(":iduser", $datosCliente["iduser"], PDO::PARAM_INT);
            if($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }

        #Crear cliente en la base de datos.
        public function crearClienteBD($nombreCliente){
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
            $sql -> close();
            $sql = null;
        }

        #Deshabilitar uno o más clientes del sistema.
        public function eliminarClientesBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "UPDATE user set status = 0 WHERE tipo = 0 AND iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            if ($sql -> execute()) {
                return $clienteId;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }

        #Contar mascotas del cliente desde la base de datos.
        public function contarMascotasClienteBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "SELECT count(*) as num_mascotas FROM mascota WHERE status = 1 AND iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }
    }
<?php
    require_once 'Conexion.php'; 
    class CRUD extends Conexion{
        #Seleccionar clientes de la base de datos.
        public function seleccionarClientesBD(){
            $sql = Conexion::conectar() -> prepare("
                select u.iduser, u.nombre, u.tipo, u.fecha, 
                date_format(u.fecha, '%d/%M/%Y') fecha 
                from user u 
                where u.status = 1 and u.tipo = 0;
            ");
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }
        
        #Seleccionar cliente de la base de datos.
        public function seleccionarClienteBD($clienteId){
            $sql = Conexion::conectar() -> prepare("
                select nombre from user 
                where status = 1 and tipo = 0 and iduser = :iduser;
            ");
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }

        #Crear cliente en la base de datos.
        public function crearClienteBD($nombreCliente){
            $sql = Conexion::conectar() -> prepare(
                "insert into user(nombre, fecha, tipo, status) value(:nombre, now(), 0, 1);"
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

        #Contar mascotas del cliente desde la base de datos.
        public function contarMascotasClienteBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "select count(*) as num_mascotas from mascota where status = 1 and iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }
        
        #Contar mascotas del cliente desde la base de datos.
        public function mascotasClienteBD($clienteId){
            $sql = Conexion::conectar() -> prepare(
                "select 
                u.nombre as cliente, m.nombre as mascota 
                from mascota m 
                inner join user u on m.iduser = u.iduser 
                where m.iduser = :iduser;"
            );
            $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }

        #Seleccionar usuarios de la base de datos.
        public function seleccionarUsuariosBD(){
            $sql = Conexion::conectar() -> prepare("
                select u.iduser, u.nombre, u.tipo, u.fecha, u_a.status, 
                date_format(u.fecha, '%d/%M/%Y') fecha 
                from user u 
                inner join user_acceso u_a on u.iduser = u_a.iduser 
                where u.status = 1 and u.tipo > 0;
            ");
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }

        #Confirmar los datos de un usuario al iniciar sesión
        public function iniciarSesionBD($usuario, $contrasena){
            $sql = Conexion::conectar() -> prepare("SELECT iduser, usuario, contrasena, status FROM 
            user_acceso WHERE usuario = :usuario AND contrasena = :contrasena AND status = 0;");
            $sql ->bindParam(":usuario",$usuario,PDO::PARAM_STR);
            $sql ->bindParam(":contrasena",$contrasena,PDO::PARAM_STR);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }
        
        #Seleccionar usuario que inició sesión en el sistema desde la base de datos.
        public function seleccionarUsuarioSesionBD($usuarioSesion){
            $sql = Conexion::conectar() -> prepare("
                select u.nombre, u_a.iduser, u_a.usuario, u_a.status 
                from user u 
                inner join user_acceso u_a on u_a.iduser = u.iduser 
                where u.iduser = :iduser;
            ");
            $sql -> bindParam(":iduser", $usuarioSesion, PDO::PARAM_STR);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }

        #Cambiar a desconectado el status del usuario hacia la base de datos.
        public function desconectarUsuarioBD($usuario){
            $sql = Conexion::conectar() -> prepare("update user_acceso set status = 0 where iduser = :iduser;");
            $sql -> bindParam(":iduser", $usuario, PDO::PARAM_STR);
            if ($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }
        
        #Cambiar a conectado el status del usuario hacia la base de datos.
        public function conectarUsuarioBD($usuario){
            $sql = Conexion::conectar() -> prepare("update user_acceso set status = 1 where iduser = :iduser;");
            $sql -> bindParam(":iduser", $usuario, PDO::PARAM_STR);
            if ($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }

        #Crear cuenta de usuario en la base de datos.
        public function crearCuentaBD($datosUsuario){
            $transaccion = true;
            $sql = Conexion::conectar() -> prepare("
                insert into user(nombre, fecha, tipo, status) value(:nombre, now(), :tipo, 2);
            ");
            $sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
            $sql -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
            if ($sql -> execute()) {
                $transaccion = true;
            }else{
                return false;
                $sql -> close();
                $sql = null;
            }

            if ($transaccion) {
                $sql2 = Conexion::conectar() -> prepare(
                    "select iduser from user where nombre = :nombre and tipo = :tipo and status = 2;"
                );
                $sql2 -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
                $sql2 -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
                $sql2 -> execute();
                $usuario = $sql2 -> fetch();
                $crearAcceso = CRUD::crearAccesoUsuarioBD($usuario, $datosUsuario);
                if ($crearAcceso) {
                    $sql3 = Conexion::conectar() -> prepare(
                        "update user set status = 1 where iduser = :iduser and status = 2;"
                    );
                    $sql3 -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
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
        public function crearAccesoUsuarioBD($usuario, $datosAcceso){
            $sql = Conexion::conectar() -> prepare(
                "insert into user_acceso(iduser, usuario, contrasena, fecha, status) 
                value(:iduser, :usuario, :contrasena, now(), 0);"
            );
            $sql -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
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
    }
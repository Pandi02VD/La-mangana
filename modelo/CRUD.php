<?php
    require_once 'Conexion.php'; 
    class CRUD extends Conexion{
        #Seleccionar usuarios de la base de datos.
        public function seleccionarUsuariosBD(){
            $sql = Conexion::conectar() -> prepare("
                select u.nombre, u.tipo, u.fecha, u_a.status 
                from user u 
                inner join user_acceso u_a on u.iduser = u_a.iduser 
                where u.status = 1;
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
                return "desconectado";
            }else{
                return "error";
            }
            $sql -> close();
            $sql = null;
        }
        
        #Cambiar a conectado el status del usuario hacia la base de datos.
        public function conectarUsuarioBD($usuario){
            $sql = Conexion::conectar() -> prepare("update user_acceso set status = 1 where iduser = :iduser;");
            $sql -> bindParam(":iduser", $usuario, PDO::PARAM_STR);
            if ($sql -> execute()) {
                return "conectado";
            }else{
                return "error";
            }
            $sql -> close();
            $sql = null;
        }
    }
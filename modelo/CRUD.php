<?php
    require_once 'Conexion.php'; 
    class CRUD extends Conexion{
        #Seleccionar usuarios de la base de datos.
        public function seleccionarUsuariosBD(){
            $sql = Conexion::conectar() -> prepare("select * from user;");
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }

        #Confirmar los datos de un usuario al iniciar sesión
        public function iniciarSesionBD($usuario, $contrasena){
            $sql = Conexion::conectar() -> prepare("SELECT nombre, usuario, contrasena, tipo, status FROM 
            user WHERE usuario = :usuario AND contrasena = :contrasena;");
            $sql ->bindParam(":usuario",$usuario,PDO::PARAM_STR);
            $sql ->bindParam(":contrasena",$contrasena,PDO::PARAM_STR);
            $sql -> execute();
            return $sql -> fetch();
            $sql -> close();
            $sql = null;
        }

        #
    }
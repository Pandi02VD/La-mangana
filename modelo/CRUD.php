<?php
    require_once 'Conexion.php'; 
    class CRUD extends Conexion{
        public function seleccionarUsuariosMdl(){
            $sql = Conexion::conectar() -> prepare("select * from user;");
            $sql -> execute();
            return $sql -> fetchAll();
            $sql -> close();
            $sql = null;
        }
    }
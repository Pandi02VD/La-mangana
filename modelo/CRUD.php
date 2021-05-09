<?php
    require_once 'Conexion.php'; 
    class CRUD extends Conexion{
        // #Seleccionar clientes de la base de datos.
        // public function seleccionarClientesBD(){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT u.iduser, u.nombre, u.tipo, u.fecha, 
        //         date_format(u.fecha, '%d/%M/%Y') fecha FROM user u WHERE u.status = 1 AND u.tipo = 0;"
        //     );
        //     $sql -> execute();
        //     return $sql -> fetchAll();
        //     $sql -> close();
        //     $sql = null;
        // }
        
        // #Seleccionar cliente de la base de datos.
        // public function seleccionarClienteBD($clienteId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT nombre FROM user 
        //         WHERE status = 1 AND tipo = 0 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetch();
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Seleccionar correos electrónicos del cliente de la base de datos.
        // public function seleccionarClienteCorreosBD($clienteId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT correo FROM user_correo 
        //         WHERE status = 1 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetchAll();
        //     $sql -> close();
        //     $sql = null;
        // }
        
        // #Seleccionar teléfonos del cliente de la base de datos.
        // public function seleccionarClienteTelefonosBD($clienteId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT numero, tipo FROM user_telefono 
        //         WHERE status = 1 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetchAll();
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Recuperar datos de cliente de la base de datos.
        // public function datosClienteBD($clienteId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT nombre as cliente FROM user 
        //         WHERE tipo = 0 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetch();
        //     $sql -> close();
        //     $sql = null;
        // }
        
        // #Actualizar datos de cliente en la base de datos.
        // public function actualizarClienteBD($datosCliente){
        //     $sql = Conexion::conectar() -> prepare(
        //         "UPDATE user set nombre = :nombre 
        //         WHERE tipo = 0 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":nombre", $datosCliente["nombre"], PDO::PARAM_STR);
        //     $sql -> bindParam(":iduser", $datosCliente["iduser"], PDO::PARAM_INT);
        //     if($sql -> execute()) {
        //         return true;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Crear cliente en la base de datos.
        // public function crearClienteBD($nombreCliente){
        //     $sql = Conexion::conectar() -> prepare(
        //         "INSERT INTO user(nombre, fecha, tipo, status) 
        //         VALUE(:nombre, now(), 0, 1);"
        //     );
        //     $sql -> bindParam(":nombre", $nombreCliente, PDO::PARAM_STR);
        //     if($sql -> execute()) {
        //         return true;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }
        
        #Agregar nuevo correo electrónico en la base de datos.
        public function nuevoCorreoBD($datosCorreoPersona){
            $sql = Conexion::conectar() -> prepare(
                "INSERT INTO user_correo(iduser, correo, status) 
                VALUE(:iduser, :correo, 1);"
            );
            $sql -> bindParam(":iduser", $datosCorreoPersona["personaId"], PDO::PARAM_INT);
            $sql -> bindParam(":correo", $datosCorreoPersona["correo"], PDO::PARAM_STR);
            if($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }
        
        #Agregar nuevo teléfono en la base de datos.
        public function nuevoTelefonoBD($datosTelefonoPersona){
            $sql = Conexion::conectar() -> prepare(
                "INSERT INTO user_telefono(iduser, tipo, numero, status) 
                VALUE(:iduser, :tipo, :numero, 1);"
            );
            $sql -> bindParam(":iduser", $datosTelefonoPersona["personaId"], PDO::PARAM_INT);
            $sql -> bindParam(":numero", $datosTelefonoPersona["telefono"], PDO::PARAM_STR);
            $sql -> bindParam(":tipo", $datosTelefonoPersona["tipo"], PDO::PARAM_INT);
            if($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }
        
        #Agregar nuevo domicilio en la base de datos.
        public function nuevoDomicilioBD($datosDomicilioPersona){
            $sql = Conexion::conectar() -> prepare(
                "INSERT INTO user_domicilio(
                    iduser, estado, localidad, colonia, calle, num_casaex, 
                    num_casaint, entre_calles, referencia, status
                ) 
                VALUE(
                    :iduser, :estado, :localidad, :colonia, :calle, :num_casaex, 
                    :num_casaint, :entre_calles, :referencia, 1
                );"
            );

            $entreCalles = $datosDomicilioPersona["calle1"]." y ".$datosDomicilioPersona["calle2"];

            $sql -> bindParam(":iduser", $datosDomicilioPersona["personaId"], PDO::PARAM_INT);
            $sql -> bindParam(":estado", $datosDomicilioPersona["estado"], PDO::PARAM_STR);
            $sql -> bindParam(":localidad", $datosDomicilioPersona["municipio"], PDO::PARAM_STR);
            $sql -> bindParam(":colonia", $datosDomicilioPersona["colonia"], PDO::PARAM_STR);
            $sql -> bindParam(":calle", $datosDomicilioPersona["calle"], PDO::PARAM_STR);
            $sql -> bindParam(":num_casaex", $datosDomicilioPersona["numeroE"], PDO::PARAM_INT);
            $sql -> bindParam(":num_casaint", $datosDomicilioPersona["numeroI"], PDO::PARAM_INT);
            $sql -> bindParam(":entre_calles", $entreCalles, PDO::PARAM_STR);
            $sql -> bindParam(":referencia", $datosDomicilioPersona["referencia"], PDO::PARAM_STR);
            if($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }

        #Actualizar el correo electrónico en la base de datos.
        public function actualizarCorreoBD($datosCorreoPersona){
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
            $sql -> close();
            $sql = null;
        }
        
        #Deshabilitar uno o más correos electrónicos en la base de datos.
        public function eliminarCorreoBD($personaId){
            $sql = Conexion::conectar() -> prepare(
                "UPDATE user_correo SET status = 0 WHERE iduser_correo = :iduser_correo;"
            );
            $sql -> bindParam(":iduser_correo", $personaId, PDO::PARAM_INT);
            if($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }

        // #Deshabilitar uno o más clientes del sistema.
        // public function eliminarClientesBD($clienteId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "UPDATE user set status = 0 WHERE tipo = 0 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
        //     if ($sql -> execute()) {
        //         return $clienteId;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Contar mascotas del cliente desde la base de datos.
        // public function contarMascotasClienteBD($clienteId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT count(*) as num_mascotas FROM mascota WHERE status = 1 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetch();
        //     $sql -> close();
        //     $sql = null;
        // }
        
        // #Selecionar información de las mascotas del cliente desde la base de datos.
        // public function mascotasClienteBD($clienteId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT 
        //         u.nombre as cliente, m.idmascota, m.nombre as mascota, 
        //         m.sexo, m.ano_nacimiento, m_r.idmascota_raza 
        //         FROM mascota m 
        //         INNER JOIN user u ON m.iduser = u.iduser 
        //         INNER JOIN mascota_raza m_r ON m.idmascota_raza = m_r.idmascota_raza 
        //         INNER JOIN mascota_especie m_e ON m_r.idmascota_especie = m_e.idmascota_especie 
        //         WHERE m.iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $clienteId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetchAll();
        //     $sql -> close();
        //     $sql = null;
        // }
        
        // #Seleccionar raza de mascota desde la base de datos.
        // public function seleccionarRazaMascotaBD($razaId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT raza FROM mascota_raza WHERE idmascota_raza = :idmascota_raza;"
        //     );
        //     $sql -> bindParam(":idmascota_raza", $razaId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetch();
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Seleccionar usuarios de la base de datos.
        // public function seleccionarUsuariosBD(){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT u.iduser, u.nombre, u.tipo, u.fecha, u_a.status, 
        //         date_format(u.fecha, '%d/%M/%Y') fecha 
        //         FROM user u 
        //         INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
        //         WHERE u.status = 1 AND u.tipo > 0;"
        //     );
        //     $sql -> execute();
        //     return $sql -> fetchAll();
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Seleccionar estado de conexión de los usuarios activos de la base de datos.
        // public function seleccionarConexionUsuariosBD(){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT u.iduser, u_a.status FROM user u 
        //         INNER JOIN user_acceso u_a ON u.iduser = u_a.iduser 
        //         WHERE u.status = 1 AND u.tipo > 0;"
        //     );
        //     $sql -> execute();
        //     return $sql -> fetchAll();
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Confirmar los datos de un usuario al iniciar sesión
        // public function iniciarSesionBD($usuario, $contrasena){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT iduser, usuario, contrasena, status FROM 
        //         user_acceso WHERE usuario = :usuario AND contrasena = :contrasena AND status = 0;"
        //     );
        //     $sql ->bindParam(":usuario",$usuario,PDO::PARAM_STR);
        //     $sql ->bindParam(":contrasena",$contrasena,PDO::PARAM_STR);
        //     $sql -> execute();
        //     return $sql -> fetch();
        //     $sql -> close();
        //     $sql = null;
        // }
        
        // #Seleccionar usuario que inició sesión en el sistema desde la base de datos.
        // public function seleccionarUsuarioSesionBD($usuarioSesion){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT u.nombre, u.tipo, u_a.iduser, u_a.usuario, u_a.status 
        //         FROM user u INNER JOIN user_acceso u_a ON u_a.iduser = u.iduser WHERE u.iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $usuarioSesion, PDO::PARAM_STR);
        //     $sql -> execute();
        //     return $sql -> fetch();
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Recuperar datos de usuario de la base de datos.
        // public function datosUsuarioBD($usuarioId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "SELECT nombre, tipo FROM user 
        //         WHERE tipo > 0 AND tipo < 4 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $usuarioId, PDO::PARAM_INT);
        //     $sql -> execute();
        //     return $sql -> fetch();
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Actualizar datos de usuario en la base de datos.
        // public function actualizarUsuarioBD($datosUsuario){
        //     $sql = Conexion::conectar() -> prepare(
        //         "UPDATE user SET nombre = :nombre, tipo = :tipo WHERE iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
        //     $sql -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
        //     $sql -> bindParam(":iduser", $datosUsuario["iduser"], PDO::PARAM_INT);
        //     if($sql -> execute()) {
        //         return true;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Cambiar a desconectado el status del usuario hacia la base de datos.
        // public function desconectarUsuarioBD($usuario){
        //     $sql = Conexion::conectar() -> prepare(
        //         "UPDATE user_acceso SET status = 0 WHERE iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $usuario, PDO::PARAM_STR);
        //     if ($sql -> execute()) {
        //         return true;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }
        
        // #Cambiar a conectado el status del usuario hacia la base de datos.
        // public function conectarUsuarioBD($usuario){
        //     $sql = Conexion::conectar() -> prepare(
        //         "UPDATE user_acceso SET status = 1 WHERE iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $usuario, PDO::PARAM_STR);
        //     if ($sql -> execute()) {
        //         return true;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Crear cuenta de usuario en la base de datos.
        // public function crearCuentaBD($datosUsuario){
        //     $transaccion = true;
        //     $sql = Conexion::conectar() -> prepare(
        //         "INSERT INTO user(nombre, fecha, tipo, status) VALUE(:nombre, now(), :tipo, 2);"
        //     );
        //     $sql -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
        //     $sql -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
        //     if ($sql -> execute()) {
        //         $transaccion = true;
        //     }else{
        //         return false;
        //         $sql -> close();
        //         $sql = null;
        //     }

        //     if ($transaccion) {
        //         $sql2 = Conexion::conectar() -> prepare(
        //             "select iduser from user where nombre = :nombre AND tipo = :tipo AND status = 2;"
        //         );
        //         $sql2 -> bindParam(":nombre", $datosUsuario["nombre"], PDO::PARAM_STR);
        //         $sql2 -> bindParam(":tipo", $datosUsuario["tipo"], PDO::PARAM_INT);
        //         $sql2 -> execute();
        //         $usuario = $sql2 -> fetch();
        //         $crearAcceso = CRUD::crearAccesoUsuarioBD($usuario, $datosUsuario);
        //         if ($crearAcceso) {
        //             $sql3 = Conexion::conectar() -> prepare(
        //                 "UPDATE user set status = 1 where iduser = :iduser AND status = 2;"
        //             );
        //             $sql3 -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
        //             if ($sql3 -> execute()) {
        //                 return true;
        //             }else{
        //                 return false;
        //             }
        //         }
        //     }
        //     $sql -> close();
        //     $sql2 -> close();
        //     $sql3 -> close();
        //     $sql = null;
        //     $sql2 = null;
        //     $sql3 = null;
        // }

        // #Crear acceso de usuario en la base de datos.
        // public function crearAccesoUsuarioBD($usuario, $datosAcceso){
        //     $sql = Conexion::conectar() -> prepare(
        //         "INSERT INTO user_acceso(iduser, usuario, contrasena, fecha, status) 
        //         VALUE(:iduser, :usuario, :contrasena, now(), 0);"
        //     );
        //     $sql -> bindParam(":iduser", $usuario["iduser"], PDO::PARAM_INT);
        //     $sql -> bindParam(":usuario", $datosAcceso["usuario"], PDO::PARAM_STR);
        //     $sql -> bindParam(":contrasena", $datosAcceso["contrasena"], PDO::PARAM_STR);
        //     if($sql -> execute()){
        //         return true;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }

        // #Deshabilitar uno o más usuarios del sistema.
        // public function eliminarUsuariosBD($usuarioId){
        //     $sql = Conexion::conectar() -> prepare(
        //         "UPDATE user SET status = 0 WHERE tipo != 1 AND iduser = :iduser;"
        //     );
        //     $sql -> bindParam(":iduser", $usuarioId, PDO::PARAM_INT);
        //     if ($sql -> execute()) {
        //         return $usuarioId;
        //     }else{
        //         return false;
        //     }
        //     $sql -> close();
        //     $sql = null;
        // }
    }
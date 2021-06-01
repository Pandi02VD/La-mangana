<?php
    require_once 'Conexion.php'; 
    class CRUD extends Conexion{
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
                    num_casaint, calle1, calle2, referencia, status
                ) 
                VALUE(
                    :iduser, :estado, :localidad, :colonia, :calle, :num_casaex, 
                    :num_casaint, :calle1, :calle2, :referencia, 1
                );"
            );

            $sql -> bindParam(":iduser", $datosDomicilioPersona["personaId"], PDO::PARAM_INT);
            $sql -> bindParam(":estado", $datosDomicilioPersona["estado"], PDO::PARAM_STR);
            $sql -> bindParam(":localidad", $datosDomicilioPersona["municipio"], PDO::PARAM_STR);
            $sql -> bindParam(":colonia", $datosDomicilioPersona["colonia"], PDO::PARAM_STR);
            $sql -> bindParam(":calle", $datosDomicilioPersona["calle"], PDO::PARAM_STR);
            $sql -> bindParam(":num_casaex", $datosDomicilioPersona["numeroE"], PDO::PARAM_INT);
            $sql -> bindParam(":num_casaint", $datosDomicilioPersona["numeroI"], PDO::PARAM_INT);
            $sql -> bindParam(":calle1", $datosDomicilioPersona["calle1"], PDO::PARAM_STR);
            $sql -> bindParam(":calle2", $datosDomicilioPersona["calle2"], PDO::PARAM_STR);
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
        
        #Actualizar el teléfono en la base de datos.
        public function actualizarTelefonoBD($datosTelefonoPersona){
            $sql = Conexion::conectar() -> prepare(
                "UPDATE user_telefono SET numero = :numero, tipo = :tipo WHERE iduser_telefono = :iduser_telefono;"
            );
            $sql -> bindParam(":numero", $datosTelefonoPersona["numero"], PDO::PARAM_STR);
            $sql -> bindParam(":tipo", $datosTelefonoPersona["tipo"], PDO::PARAM_INT);
            $sql -> bindParam(":iduser_telefono", $datosTelefonoPersona["telefonoId"], PDO::PARAM_INT);
            if($sql -> execute()) {
                return true;
            }else{
                return false;
            }
            $sql -> close();
            $sql = null;
        }
        
        #Actualizar el domicilio en la base de datos.
        public function actualizarDomicilioBD($datosDomicilioPersona){
            $sql = Conexion::conectar() -> prepare(
                "UPDATE user_domicilio SET 
                    estado = :estado, 
                    localidad = :localidad, 
                    colonia = :colonia, 
                    calle = :calle, 
                    num_casaex = :num_casaex, 
                    num_casaint = :num_casaint, 
                    calle1 = :calle1, 
                    calle2 = :calle2, 
                    referencia = :referencia 
                WHERE iduser_domicilio = :iduser_domicilio;"
            );
            $sql -> bindParam(":iduser_domicilio", $datosDomicilioPersona["domicilioId"], PDO::PARAM_INT);
            $sql -> bindParam(":estado", $datosDomicilioPersona["estado"], PDO::PARAM_STR);
            $sql -> bindParam(":localidad", $datosDomicilioPersona["municipio"], PDO::PARAM_STR);
            $sql -> bindParam(":colonia", $datosDomicilioPersona["colonia"], PDO::PARAM_STR);
            $sql -> bindParam(":calle", $datosDomicilioPersona["calle"], PDO::PARAM_STR);
            $sql -> bindParam(":num_casaex", $datosDomicilioPersona["numeroE"], PDO::PARAM_INT);
            $sql -> bindParam(":num_casaint", $datosDomicilioPersona["numeroI"], PDO::PARAM_INT);
            $sql -> bindParam(":calle1", $datosDomicilioPersona["calle1"], PDO::PARAM_STR);
            $sql -> bindParam(":calle2", $datosDomicilioPersona["calle2"], PDO::PARAM_STR);
            $sql -> bindParam(":referencia", $datosDomicilioPersona["referencia"], PDO::PARAM_STR);
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
    }
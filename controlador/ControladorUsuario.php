<?php
    class ControladorUsuario{
        #Seleccionar los usuarios 
        public function seleccionarUsuariosCtl(){
            $respuesta = CRUDUsuario::seleccionarUsuariosBD();
            return $respuesta;
        }

        #Seleccionar estado de conexión de los usuarios activos.
        public function seleccionarConexionUsuariosCtl(){
            $respuesta = CRUDUsuario::seleccionarConexionUsuariosBD();
            return $respuesta;
        }
        

        #Recuperar datos de usuario.
        public function datosUsuarioCtl($usuarioId){
            $respuesta = CRUDUsuario::datosUsuarioBD($usuarioId);
            return $respuesta;
        }

        #Actualizar datos de usuario.
        static public function actualizarUsuarioCtl(){
            if (isset($_POST["usuarioId-edit"])) {
                $datosUsuario = array(
                    "iduser" => $_POST["usuarioId-edit"], 
                    "nombre" => $_POST["nombre-edit"], 
                    "tipo" => $_POST["tipo-usuario-edit"]
                );
                $respuesta = CRUDUsuario::actualizarUsuarioBD($datosUsuario);
                if($respuesta) {
                    echo '
                    <script>
                    window.location = "index.php?pagina=Usuarios";
                        alert("Datos actualizados");
                    </script>
                    ';
                }else{
                    echo '
                    <script>
                        alert("Error al actualizar");
                        window.location = "index.php?pagina=Usuarios";
                    </script>
                    ';
                }
            }
        }

        #Abrir la sesión de usuario.
        public function iniciarSesionCtl(){
            if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
                $respuesta = CRUDUsuario::iniciarSesionBD($_POST["usuario"], $_POST["contrasena"]);
                if ($respuesta["usuario"] == null) {
                    echo '<span>Error</span>';
                }elseif ($respuesta["usuario"] == $_POST["usuario"] && $respuesta["contrasena"] == $_POST["contrasena"]) {
                    $datosUsuario = CRUDUsuario::seleccionarUsuarioSesionBD($respuesta["iduser"]);
                    $conectarUsuario = CRUDUsuario::conectarUsuarioBD($respuesta["iduser"]);
                    if ($datosUsuario["nombre"] == null) {
                        echo '
                            <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                                window.location = "index.php?pagina=IniciarSesion";
                            </script>
                        ';
                    }elseif ($datosUsuario["iduser"] == $respuesta["iduser"] && $conectarUsuario == true) {
                        $_SESSION["ingresado"] = $datosUsuario["nombre"];
                        $_SESSION["usuario"] = $datosUsuario["iduser"];
                        $_SESSION["tipo-usuario"] = $datosUsuario["tipo"];
                        echo '
                            <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                                window.location = "index.php?pagina=Inicio";
                            </script>
                            ';
                    }
                }
            }
        }
        
        #Cerrar la sesión de usuario.
        public function desconectarUsuarioCtl($usuario){
            $desconectar = CRUDUsuario::desconectarUsuarioBD($usuario);
            return $desconectar;
        }

        #Crear cuenta de usuario.
        public function crearCuentaCtl(){
            if (isset($_POST["tipo-usuario-new"])) {
                $datosUsuario = array(
                    "tipo" => $_POST["tipo-usuario-new"], 
                    "nombre" => $_POST["nombre-new"], 
                    "usuario" => $_POST["usuario-new"], 
                    "contrasena" => $_POST["contrasena-new"]
                );
                $crearUsuario = CRUDUsuario::crearCuentaBD($datosUsuario);
                if ($crearUsuario) {
                    echo '
                        <script>
                        window.location = "index.php?pagina=Usuarios";
                            alert("Usuario creado");
                        </script>
                        ';
                }else{
                    echo '
                        <script>
                        window.location = "index.php?pagina=Usuarios";
                            alert("Ha ocurrido un error consulte al desarrollador");
                        </script>
                        ';
                }
            }
        }

        #Deshabilitar uno o más usuarios.
        public function eliminarUsuariosCtl($usuariosElegidosEliminar){
            $respuestas = array();
            $conclusion = true;
            for ($i = 0; $i < sizeof($usuariosElegidosEliminar); $i++) {
                $respuesta = CRUDUsuario::eliminarUsuariosBD($usuariosElegidosEliminar[$i]);
                if ($respuesta == false) {
                    $respuestas[$i] = false;
                }
            }
            
            for ($i = 0; $i < sizeof($respuestas); $i++) {
                if ($respuestas[$i] == false) {
                    $conclusion = false;
                }
            }
            return $conclusion;
        }
    }
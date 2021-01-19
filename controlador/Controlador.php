<?php
    class Controlador{
        public function plantilla(){
            include 'vista/Plantilla.php';
        }
        
        #Traer las vistas.
        public function traerPaginaCtl(){
            if (isset($_GET["pagina"])) {
                $pagina = $_GET["pagina"];
            }else{
                $pagina = "index";
            }
            $respuesta = Pagina::traerPagina($pagina);
            include $respuesta;
        }

        #Seleccionar los clientes 
        public function seleccionarClientesCtl(){
            $respuesta = CRUD::seleccionarClientesBD();
            return $respuesta;
        }
        
        #Seleccionar los clientes 
        public function seleccionarClienteCtl($clienteId){
            $respuesta = CRUD::seleccionarClienteBD($clienteId);
            return $respuesta;
        }

        #Crear cliente.
        public function crearClienteCtl(){
            if (isset($_POST["cliente"])) {
                $respuesta = CRUD::crearClienteBD($_POST["cliente"]);
                if ($respuesta) {
                    if (isset($_POST["vinculo-animal"])) {
                        echo '<span>Vínculo creado</span>';
                    }else{
                        echo '<span>Cliente creado sin vínculo</span>';
                    }
                }else{
                    echo '<span>Error al crear el cliente</span>';
                }
            }
        }

        #Contar mascotas del cliente.
        public function contarMascotasClienteCtl($clienteId){
            $respuesta = CRUD::contarMascotasClienteBD($clienteId);
            return $respuesta;
        }

        #Seleccionar las mascotas del cliente.
        public function mascotasClienteCtl($clienteId){
            $respuesta = CRUD::mascotasClienteBD($clienteId);
            return $respuesta;
        }

        #Seleccionar los usuarios 
        public function seleccionarUsuariosCtl(){
            $respuesta = CRUD::seleccionarUsuariosBD();
            return $respuesta;
        }

        #Abrir la sesión de usuario.
        public function iniciarSesionCtl(){
            if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
                $respuesta = CRUD::iniciarSesionBD($_POST["usuario"], $_POST["contrasena"]);
                if ($respuesta["usuario"] == null) {
                    echo '<span>Error</span>';
                }elseif ($respuesta["usuario"] == $_POST["usuario"] && $respuesta["contrasena"] == $_POST["contrasena"]) {
                    $datosUsuario = CRUD::seleccionarUsuarioSesionBD($respuesta["iduser"]);
                    $conectarUsuario = CRUD::conectarUsuarioBD($respuesta["iduser"]);
                    if ($datosUsuario["nombre"] == null) {
                        echo '<span>Error</span>';
                    }elseif ($datosUsuario["iduser"] == $respuesta["iduser"] && $conectarUsuario == true) {
                        $_SESSION["ingresado"] = $datosUsuario["nombre"];
                        $_SESSION["usuario"] = $datosUsuario["iduser"];
                        echo '
                            <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                                window.location = "index.php?pagina=Usuarios";
                            </script>
                            ';
                    }
                }
            }
        }
        
        #Cerrar la sesión de usuario.
        public function desconectarUsuarioCtl($usuario){
            $desconectar = CRUD::desconectarUsuarioBD($usuario);
            return $desconectar;
        }

        #Crear cuenta de usuario.
        public function crearCuentaCtl(){
            if (isset($_POST["tipo-usuario"])) {
                $datosUsuario = array(
                    "tipo" => $_POST["tipo-usuario"], 
                    "nombre" => $_POST["nombre"], 
                    "usuario" => $_POST["usuario"], 
                    "contrasena" => $_POST["contrasena"]
                );
                $crearUsuario = CRUD::crearCuentaBD($datosUsuario);
                if ($crearUsuario) {
                    echo '<span>Usuario creado correctamente</span>';
                }else{
                    echo '<span>Error al crear el usuario</span>';
                }
            }
        }
    }
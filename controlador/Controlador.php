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

        #Recuperar datos de cliente.
        public function datosClienteCtl($clienteId){
            $respuesta = CRUD::datosClienteBD($clienteId);
            return $respuesta;
        }
        
        #Actualizar datos de cliente.
        static public function actualizarClienteCtl(){
            if (isset($_POST["clienteId-edit"])) {
                $datosCliente = array(
                    "iduser" => $_POST["clienteId-edit"], 
                    "nombre" => $_POST["cliente-edit"]
                );
                $respuesta = CRUD::actualizarClienteBD($datosCliente);
                if($respuesta) {
                    echo '
                    <script>
                    window.location = "index.php?pagina=Clientes";
                        alert("Datos actualizados");
                    </script>
                    ';
                }else{
                    echo '
                    <script>
                        alert("Error al actualizar");
                        window.location = "index.php?pagina=Clientes";
                    </script>
                    ';
                }
            }
        }

        #Crear cliente.
        public function crearClienteCtl(){
            if (isset($_POST["cliente-new"])) {
                $respuesta = CRUD::crearClienteBD($_POST["cliente-new"]);
                if ($respuesta) {
                    if (isset($_POST["vinculo-animal"])) {
                        echo '
                            <script>
                            window.location = "index.php?pagina=Clientes";
                                alert("Cliente creado con vínculo animal");
                            </script>
                            ';
                    }else{
                        echo '
                            <script>
                            window.location = "index.php?pagina=Clientes";
                                alert("Cliente creado sin vínculo animal");
                            </script>
                            ';
                    }
                }else{
                    echo '<span>Error al crear el cliente</span>';
                }
            }
        }

        #Deshabilitar uno o más clientes.
        public function eliminarClientesCtl($clientesElegidosEliminar){
            $respuestas = array();
            $conclusion = true;
            for ($i = 0; $i < sizeof($clientesElegidosEliminar); $i++) {
                $respuesta = CRUD::eliminarClientesBD($clientesElegidosEliminar[$i]);
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

        #Seleccionar estado de conexión de los usuarios activos.
        public function seleccionarConexionUsuariosCtl(){
            $respuesta = CRUD::seleccionarConexionUsuariosBD();
            return $respuesta;
        }
        
        #Seleccionar raza de mascota 
        public function seleccionarRazaMascotaCtl($razaId){
            $respuesta = CRUD::seleccionarRazaMascotaBD($razaId);
            return $respuesta;
        }

        #Recuperar datos de usuario.
        public function datosUsuarioCtl($usuarioId){
            $respuesta = CRUD::datosUsuarioBD($usuarioId);
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
                $respuesta = CRUD::actualizarUsuarioBD($datosUsuario);
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
            $desconectar = CRUD::desconectarUsuarioBD($usuario);
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
                $crearUsuario = CRUD::crearCuentaBD($datosUsuario);
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
                $respuesta = CRUD::eliminarUsuariosBD($usuariosElegidosEliminar[$i]);
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
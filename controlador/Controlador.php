<?php
    class Controlador{
        #Traer plantilla al index.
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

        // #Seleccionar los clientes 
        // public function seleccionarClientesCtl(){
        //     $respuesta = CRUD::seleccionarClientesBD();
        //     return $respuesta;
        // }
        
        // #Seleccionar un cliente
        // public function seleccionarClienteCtl($clienteId){
        //     $respuesta = CRUD::seleccionarClienteBD($clienteId);
        //     return $respuesta;
        // }

        // #Seleccionar todos los correos electrónicos del cliente.
        // public function seleccionarClienteCorreosCtl($clienteId){
        //     $respuesta = CRUDCliente::seleccionarClienteCorreosBD($clienteId);
        //     return $respuesta;
        // }
        
        // #Seleccionar todos los teléfonos del cliente.
        // public function seleccionarClienteTelefonosCtl($clienteId){
        //     $respuesta = CRUDCliente::seleccionarClienteTelefonosBD($clienteId);
        //     return $respuesta;
        // }
        
        // #Seleccionar todos los domicilios del cliente.
        // public function seleccionarClienteDomiciliosCtl($clienteId){
        //     $respuesta = CRUDCliente::seleccionarClienteDomiciliosBD($clienteId);
        //     return $respuesta;
        // }

        // #Recuperar datos de cliente.
        // public function datosClienteCtl($clienteId){
        //     $respuesta = CRUDCliente::datosClienteBD($clienteId);
        //     return $respuesta;
        // }
        
        // #Actualizar datos de cliente.
        // static public function actualizarClienteCtl(){
        //     if (isset($_POST["clienteId-edit"])) {
        //         $datosCliente = array(
        //             "iduser" => $_POST["clienteId-edit"], 
        //             "nombre" => $_POST["cliente-edit"]
        //         );
        //         $respuesta = CRUDCliente::actualizarClienteBD($datosCliente);
        //         if($respuesta) {
        //             echo '
        //             <script>
        //             window.location = "index.php?pagina=Clientes";
        //                 alert("Datos actualizados");
        //             </script>
        //             ';
        //         }else{
        //             echo '
        //             <script>
        //                 alert("Error al actualizar");
        //                 window.location = "index.php?pagina=Clientes";
        //             </script>
        //             ';
        //         }
        //     }
        // }

        // #Crear cliente.
        // public function crearClienteCtl(){
        //     if (isset($_POST["cliente-new"])) {
        //         $respuesta = CRUDCliente::crearClienteBD($_POST["cliente-new"]);
        //         if ($respuesta) {
        //             if (isset($_POST["vinculo-animal"])) {
        //                 echo '
        //                     <script>
        //                     window.location = "index.php?pagina=Clientes";
        //                         alert("Cliente creado con vínculo animal");
        //                     </script>
        //                     ';
        //             }else{
        //                 echo '
        //                     <script>
        //                     window.location = "index.php?pagina=Clientes";
        //                         alert("Cliente creado sin vínculo animal");
        //                     </script>
        //                     ';
        //             }
        //         }else{
        //             echo '<span>Error al crear el cliente</span>';
        //         }
        //     }
        // }
        
        #Agregar nuevo correo electrónico.
        public function nuevoCorreoCtl(){
            if (
                isset($_POST["cliente-correo-new"]) && 
                isset($_POST["cliente-add-email-id"])
            ) {
                $datosCorreoCliente = array(
                    "personaId" => $_POST["cliente-add-email-id"], 
                    "correo" => $_POST["cliente-correo-new"]
                );
                $respuesta = CRUD::nuevoCorreoBD($datosCorreoCliente);
                if ($respuesta == true) {
                    echo '
                            <script>
                                alert("Correo electrónico agregado correctamente");
                                window.location = "index.php?pagina=Cliente&uc=' . $datosCorreoCliente["personaId"] . '";
                            </script>
                        ';
                }else{
                    echo '
                            <script>
                                alert("Error al agregar el correo electrónico");
                                window.location = "index.php?pagina=Cliente&uc=' . $datosCorreoCliente["personaId"] . '";
                            </script>
                        ';
                }
            }
        }
        
        #Agregar nuevo teléfono.
        public function nuevoTelefonoCtl(){
            if (
                isset($_POST["cliente-telefono-new"]) && 
                isset($_POST["cliente-add-phone-id"]) && 
                isset($_POST["cliente-tipotelefono-new"])
            ) {
                $datosTelefonoCliente = array(
                    "personaId" => $_POST["cliente-add-phone-id"], 
                    "telefono" => $_POST["cliente-telefono-new"], 
                    "tipo" => $_POST["cliente-tipotelefono-new"]
                );
                $respuesta = CRUD::nuevoTelefonoBD($datosTelefonoCliente);
                if ($respuesta) {
                    echo '
                        <script>
                            window.location = "index.php?pagina=Cliente&uc=' . $datosTelefonoCliente["personaId"] . '";
                            alert("Telefono agregado correctamente");
                        </script>
                        ';
                }else{
                    echo '
                        <script>
                            window.location = "index.php?pagina=Cliente&uc=' . $datosTelefonoCliente["personaId"] . '";
                            alert("Error al agregar el teléfono");
                        </script>
                        ';
                }
            }
        }

        #Agregar nuevo domicilio.
        public function nuevoDomicilioCtl(){
            if (
                isset($_POST["cliente-domicilio-estado-new"]) && 
                isset($_POST["cliente-domicilio-municipio-new"]) && 
                isset($_POST["cliente-domicilio-colonia-new"]) && 
                isset($_POST["cliente-domicilio-calle-new"]) && 
                isset($_POST["cliente-domicilio-numero-e-new"]) && 
                isset($_POST["cliente-domicilio-numero-i-new"]) && 
                isset($_POST["cliente-domicilio-calle1-new"]) && 
                isset($_POST["cliente-domicilio-calle2-new"]) && 
                isset($_POST["cliente-domicilio-referencia-new"]) && 
                isset($_POST["cliente-add-address-id"])
            ) {
                $datosDomicilioCliente = array(
                    "personaId" => $_POST["cliente-add-address-id"], 
                    "estado" => $_POST["cliente-domicilio-estado-new"], 
                    "municipio" => $_POST["cliente-domicilio-municipio-new"], 
                    "colonia" => $_POST["cliente-domicilio-colonia-new"], 
                    "calle" => $_POST["cliente-domicilio-calle-new"], 
                    "numeroE" => $_POST["cliente-domicilio-numero-e-new"], 
                    "numeroI" => $_POST["cliente-domicilio-numero-i-new"], 
                    "calle1" => $_POST["cliente-domicilio-calle1-new"], 
                    "calle2" => $_POST["cliente-domicilio-calle2-new"], 
                    "referencia" => $_POST["cliente-domicilio-referencia-new"], 
                );
                $respuesta = CRUD::nuevoDomicilioBD($datosDomicilioCliente);
                if ($respuesta) {
                    echo '
                        <script>
                        window.location = "index.php?pagina=Cliente&uc=' . $datosDomicilioCliente["personaId"] . '";
                            alert("Domicilio agregado correctamente");
                        </script>
                    ';
                }else{
                    echo '
                        <script>
                        window.location = "index.php?pagina=Cliente&uc=' . $datosDomicilioCliente["personaId"] . '";
                            alert("Error al agregar el Domicilio");
                        </script>
                    ';
                }
            }
        }

        #Actualizar el correo electrónico.
        public function actualizarCorreoCtl($userId){
            if (isset($_POST["correo-cliente-edit"]) && isset($_POST["email-client-edit-id"])) {
                $datosCorreoCliente = array (
                    "correoId" => $_POST["email-client-edit-id"], 
                    "correo" => $_POST["correo-cliente-edit"]
                );

                $respuesta = CRUD::actualizarCorreoBD($datosCorreoCliente);
                if ($respuesta) {
                    echo '
                            <script>
                                alert("Correo electrónico actualizado");
                                window.location = "index.php?pagina=Cliente&uc=' . $userId . '";
                            </script>
                        ';
                }else{
                    echo '
                            <script>
                                alert("no se pudo actualizar el correo electrónico, revise sus datos");
                                window.location = "index.php?pagina=Cliente&uc=' . $userId . '";
                            </script>
                        ';
                }
            }
        }
        
        #Deshabilitar uno o más correos electrónicos.
        public function eliminarCorreosCtl($correosElegidosEliminar){
            $respuestas = array();
            $conclusion = true;
            for ($i = 0; $i < sizeof($correosElegidosEliminar); $i++) {
                $respuesta = CRUD::eliminarCorreosBD($correosElegidosEliminar[$i]);
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

        // #Deshabilitar uno o más clientes.
        // public function eliminarClientesCtl($clientesElegidosEliminar){
        //     $respuestas = array();
        //     $conclusion = true;
        //     for ($i = 0; $i < sizeof($clientesElegidosEliminar); $i++) {
        //         $respuesta = CRUDCliente::eliminarClientesBD($clientesElegidosEliminar[$i]);
        //         if ($respuesta == false) {
        //             $respuestas[$i] = false;
        //         }
        //     }
            
        //     for ($i = 0; $i < sizeof($respuestas); $i++) {
        //         if ($respuestas[$i] == false) {
        //             $conclusion = false;
        //         }
        //     }
        //     return $conclusion;
        // }

        // #Contar mascotas del cliente.
        // public function contarMascotasClienteCtl($clienteId){
        //     $respuesta = CRUDCliente::contarMascotasClienteBD($clienteId);
        //     return $respuesta;
        // }

        // #Seleccionar las mascotas del cliente.
        // public function mascotasClienteCtl($clienteId){
        //     $respuesta = CRUDMascota::mascotasClienteBD($clienteId);
        //     return $respuesta;
        // }

        // #Seleccionar raza de mascota 
        // public function seleccionarRazaMascotaCtl($razaId){
        //     $respuesta = CRUDMascota::seleccionarRazaMascotaBD($razaId);
        //     return $respuesta;
        // }

        // #Seleccionar los usuarios 
        // public function seleccionarUsuariosCtl(){
        //     $respuesta = CRUDUsuario::seleccionarUsuariosBD();
        //     return $respuesta;
        // }

        // #Seleccionar estado de conexión de los usuarios activos.
        // public function seleccionarConexionUsuariosCtl(){
        //     $respuesta = CRUDUsuario::seleccionarConexionUsuariosBD();
        //     return $respuesta;
        // }
        

        // #Recuperar datos de usuario.
        // public function datosUsuarioCtl($usuarioId){
        //     $respuesta = CRUDUsuario::datosUsuarioBD($usuarioId);
        //     return $respuesta;
        // }

        // #Actualizar datos de usuario.
        // static public function actualizarUsuarioCtl(){
        //     if (isset($_POST["usuarioId-edit"])) {
        //         $datosUsuario = array(
        //             "iduser" => $_POST["usuarioId-edit"], 
        //             "nombre" => $_POST["nombre-edit"], 
        //             "tipo" => $_POST["tipo-usuario-edit"]
        //         );
        //         $respuesta = CRUDUsuario::actualizarUsuarioBD($datosUsuario);
        //         if($respuesta) {
        //             echo '
        //             <script>
        //             window.location = "index.php?pagina=Usuarios";
        //                 alert("Datos actualizados");
        //             </script>
        //             ';
        //         }else{
        //             echo '
        //             <script>
        //                 alert("Error al actualizar");
        //                 window.location = "index.php?pagina=Usuarios";
        //             </script>
        //             ';
        //         }
        //     }
        // }

        // #Abrir la sesión de usuario.
        // public function iniciarSesionCtl(){
        //     if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
        //         $respuesta = CRUDUsuario::iniciarSesionBD($_POST["usuario"], $_POST["contrasena"]);
        //         if ($respuesta["usuario"] == null) {
        //             echo '<span>Error</span>';
        //         }elseif ($respuesta["usuario"] == $_POST["usuario"] && $respuesta["contrasena"] == $_POST["contrasena"]) {
        //             $datosUsuario = CRUDUsuario::seleccionarUsuarioSesionBD($respuesta["iduser"]);
        //             $conectarUsuario = CRUDUsuario::conectarUsuarioBD($respuesta["iduser"]);
        //             if ($datosUsuario["nombre"] == null) {
        //                 echo '<span>Error</span>';
        //             }elseif ($datosUsuario["iduser"] == $respuesta["iduser"] && $conectarUsuario == true) {
        //                 $_SESSION["ingresado"] = $datosUsuario["nombre"];
        //                 $_SESSION["usuario"] = $datosUsuario["iduser"];
        //                 $_SESSION["tipo-usuario"] = $datosUsuario["tipo"];
        //                 echo '
        //                     <script>
        //                     if(window.history.replaceState){
        //                         window.history.replaceState(null, null, window.location.href);
        //                     }
        //                         window.location = "index.php?pagina=Inicio";
        //                     </script>
        //                     ';
        //             }
        //         }
        //     }
        // }
        
        // #Cerrar la sesión de usuario.
        // public function desconectarUsuarioCtl($usuario){
        //     $desconectar = CRUDUsuario::desconectarUsuarioBD($usuario);
        //     return $desconectar;
        // }

        // #Crear cuenta de usuario.
        // public function crearCuentaCtl(){
        //     if (isset($_POST["tipo-usuario-new"])) {
        //         $datosUsuario = array(
        //             "tipo" => $_POST["tipo-usuario-new"], 
        //             "nombre" => $_POST["nombre-new"], 
        //             "usuario" => $_POST["usuario-new"], 
        //             "contrasena" => $_POST["contrasena-new"]
        //         );
        //         $crearUsuario = CRUDUsuario::crearCuentaBD($datosUsuario);
        //         if ($crearUsuario) {
        //             echo '
        //                 <script>
        //                 window.location = "index.php?pagina=Usuarios";
        //                     alert("Usuario creado");
        //                 </script>
        //                 ';
        //         }else{
        //             echo '
        //                 <script>
        //                 window.location = "index.php?pagina=Usuarios";
        //                     alert("Ha ocurrido un error consulte al desarrollador");
        //                 </script>
        //                 ';
        //         }
        //     }
        // }

        // #Deshabilitar uno o más usuarios.
        // public function eliminarUsuariosCtl($usuariosElegidosEliminar){
        //     $respuestas = array();
        //     $conclusion = true;
        //     for ($i = 0; $i < sizeof($usuariosElegidosEliminar); $i++) {
        //         $respuesta = CRUDUsuario::eliminarUsuariosBD($usuariosElegidosEliminar[$i]);
        //         if ($respuesta == false) {
        //             $respuestas[$i] = false;
        //         }
        //     }
            
        //     for ($i = 0; $i < sizeof($respuestas); $i++) {
        //         if ($respuestas[$i] == false) {
        //             $conclusion = false;
        //         }
        //     }
        //     return $conclusion;
        // }
    }
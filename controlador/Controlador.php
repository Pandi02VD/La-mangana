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

        #Actualizar el teléfono.
        public function actualizarTelefonoCtl($userId){
            if (
                isset($_POST["cliente-telefono-edit"]) && 
                isset($_POST["cliente-tipotelefono-edit"]) && 
                isset($_POST["client-edit-phone-id"])
            ) {
                $datosTelefonoCliente = array (
                    "telefonoId" => $_POST["client-edit-phone-id"], 
                    "numero" => $_POST["cliente-telefono-edit"], 
                    "tipo" => $_POST["cliente-tipotelefono-edit"]
                );

                $respuesta = CRUD::actualizarTelefonoBD($datosTelefonoCliente);
                if ($respuesta) {
                    echo '
                            <script>
                                alert("Teléfono actualizado");
                                window.location = "index.php?pagina=Cliente&uc=' . $userId . '";
                            </script>
                        ';
                }else{
                    echo '
                            <script>
                                alert("no se pudo actualizar el teléfono, revise sus datos");
                                window.location = "index.php?pagina=Cliente&uc=' . $userId . '";
                            </script>
                        ';
                }
            }
        }
        
        #Actualizar el domicilio.
        public function actualizarDomicilioCtl($userId){
            if (
                isset($_POST["cliente-domicilio-estado-edit"]) && 
                isset($_POST["cliente-domicilio-municipio-edit"]) && 
                isset($_POST["cliente-domicilio-colonia-edit"]) && 
                isset($_POST["cliente-domicilio-calle-edit"]) && 
                isset($_POST["cliente-domicilio-numero-e-edit"]) && 
                isset($_POST["cliente-domicilio-numero-i-edit"]) && 
                isset($_POST["cliente-domicilio-calle1-edit"]) && 
                isset($_POST["cliente-domicilio-calle2-edit"]) && 
                isset($_POST["cliente-domicilio-referencia-edit"]) && 
                isset($_POST["client-edit-address-id"])
            ) {
                $datosDomicilioCliente = array(
                    "domicilioId" => $_POST["client-edit-address-id"], 
                    "estado" => $_POST["cliente-domicilio-estado-edit"], 
                    "municipio" => $_POST["cliente-domicilio-municipio-edit"], 
                    "colonia" => $_POST["cliente-domicilio-colonia-edit"], 
                    "calle" => $_POST["cliente-domicilio-calle-edit"], 
                    "numeroE" => $_POST["cliente-domicilio-numero-e-edit"], 
                    "numeroI" => $_POST["cliente-domicilio-numero-i-edit"], 
                    "calle1" => $_POST["cliente-domicilio-calle1-edit"], 
                    "calle2" => $_POST["cliente-domicilio-calle2-edit"], 
                    "referencia" => $_POST["cliente-domicilio-referencia-edit"], 
                );

                $respuesta = CRUD::actualizarDomicilioBD($datosDomicilioCliente);
                if ($respuesta) {
                    echo '
                            <script>
                                alert("Domicilio actualizado");
                                window.location = "index.php?pagina=Cliente&uc=' . $userId . '";
                            </script>
                        ';
                }else{
                    echo '
                            <script>
                                alert("no se pudo actualizar el domicilio, revise sus datos");
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
    }
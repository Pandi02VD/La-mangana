<?php
    class ControladorCliente{
        #Seleccionar los clientes 
        public function seleccionarClientesCtl(){
            $respuesta = CRUDCliente::seleccionarClientesBD();
            return $respuesta;
        }
        
        #Seleccionar un cliente
        public function seleccionarClienteCtl($clienteId){
            $respuesta = CRUDCliente::seleccionarClienteBD($clienteId);
            return $respuesta;
        }

        #Seleccionar todos los correos electrónicos del cliente.
        public function seleccionarClienteCorreoCtl($correoId){
            $respuesta = CRUDCliente::seleccionarClienteCorreoBD($correoId);
            return $respuesta;
        }

        #Seleccionar todos los correos electrónicos del cliente.
        public function seleccionarClienteCorreosCtl($clienteId){
            $respuesta = CRUDCliente::seleccionarClienteCorreosBD($clienteId);
            return $respuesta;
        }
        
        #Seleccionar todos los teléfonos del cliente.
        public function seleccionarClienteTelefonosCtl($clienteId){
            $respuesta = CRUDCliente::seleccionarClienteTelefonosBD($clienteId);
            return $respuesta;
        }
        
        #Seleccionar todos los domicilios del cliente.
        public function seleccionarClienteDomiciliosCtl($clienteId){
            $respuesta = CRUDCliente::seleccionarClienteDomiciliosBD($clienteId);
            return $respuesta;
        }

        #Recuperar datos de cliente.
        public function datosClienteCtl($clienteId){
            $respuesta = CRUDCliente::datosClienteBD($clienteId);
            return $respuesta;
        }

        #Actualizar datos de cliente.
        static public function actualizarClienteCtl(){
            if (isset($_POST["clienteId-edit"])) {
                $datosCliente = array(
                    "iduser" => $_POST["clienteId-edit"], 
                    "nombre" => $_POST["cliente-edit"]
                );
                $respuesta = CRUDCliente::actualizarClienteBD($datosCliente);
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
                $respuesta = CRUDCliente::crearClienteBD($_POST["cliente-new"]);
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
                $respuesta = CRUDCliente::eliminarClientesBD($clientesElegidosEliminar[$i]);
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
            $respuesta = CRUDCliente::contarMascotasClienteBD($clienteId);
            return $respuesta;
        }
    }
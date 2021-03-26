<?php 
    require_once '../modelo/CRUD.php';
    require_once 'Controlador.php';

    class Ajax{
        public $usuarioElegido;
        public $clienteElegido;
        public $clientesElegidosEliminar;
        public $usuariosElegidosEliminar;
        
        public $requestClienteEmails;
        public $requestClientePhones;

        #Recuperar datos de usuario para editarlos.
        public function datosUsuarioAjax(){
            $dato = $this -> usuarioElegido;
            $respuesta = Controlador::datosUsuarioCtl($dato);
            echo json_encode($respuesta);
        }
        
        #Recuperar datos de cliente para editarlos.
        public function datosClienteAjax(){
            $dato = $this -> clienteElegido;
            $respuesta = Controlador::datosClienteCtl($dato);
            echo json_encode($respuesta);
        }
        
        #Seleccionar estado de conexión de los usuarios activos de la base de datos.
        public function seleccionarConexionUsuariosAjax(){
            $respuesta = Controlador::seleccionarConexionUsuariosCtl();
            echo json_encode($respuesta);
        }
        
        #Deshabilitar uno o más clientes.
        public function eliminarClientesAjax(){
            $datos = $this -> clientesElegidosEliminar;
            $respuesta = Controlador::eliminarClientesCtl($datos);
            // echo var_dump($datos);
            echo $respuesta;
        }
        
        #Deshabilitar uno o más usuarios.
        public function eliminarUsuariosAjax(){
            $datos = $this -> usuariosElegidosEliminar;
            $respuesta = Controlador::eliminarUsuariosCtl($datos);
            echo json_encode($respuesta);
        }

        #Seleccionar todos los correos electrónicos del cliente.
        public function seleccionarClienteCorreosAjax(){
            $requestCD = $this -> requestClienteEmails;
            $respuesta = Controlador::seleccionarClienteCorreosCtl($requestCD);
            echo json_encode($respuesta);
        }
        
        #Seleccionar todos los teléfonos del cliente.
        public function seleccionarClienteTelefonosAjax(){
            $requestCD = $this -> requestClientePhones;
            $respuesta = Controlador::seleccionarClienteTelefonosCtl($requestCD);
            echo json_encode($respuesta);
        }
    }
    
    if (isset($_POST["usuarioId"])) {
        $objUsuarioId = new Ajax();
        $objUsuarioId -> usuarioElegido = $_POST["usuarioId"];
        $objUsuarioId -> datosUsuarioAjax();
    }
    
    if (isset($_POST["clienteId"])) {
        $objClienteId = new Ajax();
        $objClienteId -> clienteElegido = $_POST["clienteId"];
        $objClienteId -> datosClienteAjax();
    }
    
    if (isset($_POST["clientesEliminarId"])) {
        $objClientesEliminarId = new Ajax();
        $objClientesEliminarId -> clientesElegidosEliminar = json_decode($_POST["clientesEliminarId"]);
        $objClientesEliminarId -> eliminarClientesAjax();
    }
    
    if (isset($_POST["usuariosEliminarId"])) {
        $objUsuariosEliminarId = new Ajax();
        $objUsuariosEliminarId -> usuariosElegidosEliminar = json_decode($_POST["usuariosEliminarId"]);
        $objUsuariosEliminarId -> eliminarUsuariosAjax();
    }
    
    if (isset($_POST["estado-usuarios"])) {
        $objEstadoUsuarios = new Ajax();
        $objEstadoUsuarios -> seleccionarConexionUsuariosAjax();
    }
    
    if (isset($_POST["requestClienteEmails"])) {
        $objRequestClienteEmails = new Ajax();
        $objRequestClienteEmails -> requestClienteEmails = $_POST["requestClienteEmails"];
        $objRequestClienteEmails -> seleccionarClienteCorreosAjax();
    }
    
    if (isset($_POST["requestClientePhones"])) {
        $objRequestClientePhones = new Ajax();
        $objRequestClientePhones -> requestClientePhones = $_POST["requestClientePhones"];
        $objRequestClientePhones -> seleccionarClienteTelefonosAjax();
    }
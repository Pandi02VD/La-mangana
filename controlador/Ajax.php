<?php 
    require_once '../modelo/CRUD.php';
    require_once '../modelo/CRUDCliente.php';
    require_once '../modelo/CRUDUsuario.php';
    require_once 'Controlador.php';
    require_once 'ControladorCliente.php';
    require_once 'ControladorUsuario.php';

    class Ajax{
        public $usuarioElegido;
        public $clienteElegido;
        public $clientesElegidosEliminar;
        public $usuariosElegidosEliminar;
        
        public $requestClientEdit;
        public $requestUserEdit;
        public $requestClientDataEdit;
        public $requestClientePhones;
        public $requestClienteAddress;
        

        #Recuperar datos de usuario para editarlos.
        public function datosUsuarioAjax(){
            $dato = $this -> requestUserEdit;
            $respuesta = ControladorUsuario::datosUsuarioCtl($dato);
            echo json_encode($respuesta);
        }
        
        #Recuperar datos de cliente para editarlos.
        public function datosClienteAjax(){
            $dato = $this -> requestClientEdit;
            $respuesta = ControladorCliente::datosClienteCtl($dato);
            echo json_encode($respuesta);
        }
        
        #Seleccionar estado de conexión de los usuarios activos de la base de datos.
        public function seleccionarConexionUsuariosAjax(){
            $respuesta = ControladorUsuario::seleccionarConexionUsuariosCtl();
            echo json_encode($respuesta);
        }
        
        #Deshabilitar uno o más clientes.
        public function eliminarClientesAjax(){
            $datos = $this -> clientesElegidosEliminar;
            $respuesta = ControladorCliente::eliminarClientesCtl($datos);
            // echo var_dump($datos);
            echo $respuesta;
        }
        
        #Deshabilitar uno o más usuarios.
        public function eliminarUsuariosAjax(){
            $datos = $this -> usuariosElegidosEliminar;
            $respuesta = ControladorUsuario::eliminarUsuariosCtl($datos);
            echo json_encode($respuesta);
        }

        #Seleccionar todos los correos electrónicos del cliente.
        public function seleccionarClienteCorreoAjax(){
            $requestCD = $this -> requestClientDataEdit;
            $respuesta = ControladorCliente::seleccionarClienteCorreoCtl($requestCD);
            echo json_encode($respuesta);
        }
        
        #Seleccionar todos los teléfonos del cliente.
        public function seleccionarClienteTelefonosAjax(){
            $requestCD = $this -> requestClientePhones;
            $respuesta = ControladorCliente::seleccionarClienteTelefonosCtl($requestCD);
            echo json_encode($respuesta);
        }
        
        #Seleccionar todos los domicilios del cliente.
        public function seleccionarClienteDomiciliosAjax(){
            $requestCD = $this -> requestClienteAddress;
            $respuesta = ControladorCliente::seleccionarClienteDomiciliosCtl($requestCD);
            echo json_encode($respuesta);
        }
    }
    
    // if (isset($_POST["usuarioId"])) {
    //     $objUsuarioId = new Ajax();
    //     $objUsuarioId -> usuarioElegido = $_POST["usuarioId"];
    //     $objUsuarioId -> datosUsuarioAjax();
    // }
    
    // if (isset($_POST["clienteId"])) {
    //     $objClienteId = new Ajax();
    //     $objClienteId -> clienteElegido = $_POST["clienteId"];
    //     $objClienteId -> datosClienteAjax();
    // }
    
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
    
    if (isset($_POST["email-client-edit-id"])) {
        $objRequestClientDataEdit = new Ajax();
        $objRequestClientDataEdit -> requestClientDataEdit = $_POST["email-client-edit-id"];
        $objRequestClientDataEdit -> seleccionarClienteCorreoAjax();
    }
    
    if (isset($_POST["clienteId-edit"])) {
        $objRequestClientEdit = new Ajax();
        $objRequestClientEdit -> requestClientEdit = $_POST["clienteId-edit"];
        $objRequestClientEdit -> datosClienteAjax();
    }
    
    if (isset($_POST["usuarioId-edit"])) {
        $objRequestUserEdit = new Ajax();
        $objRequestUserEdit -> requestUserEdit = $_POST["usuarioId-edit"];
        $objRequestUserEdit -> datosUsuarioAjax();
    }
    
    if (isset($_POST["requestClientePhones"])) {
        $objRequestClientePhones = new Ajax();
        $objRequestClientePhones -> requestClientePhones = $_POST["requestClientePhones"];
        $objRequestClientePhones -> seleccionarClienteTelefonosAjax();
    }
    
    if (isset($_POST["requestClienteAddress"])) {
        $objRequestClienteAddress = new Ajax();
        $objRequestClienteAddress -> requestClienteAddress = $_POST["requestClienteAddress"];
        $objRequestClienteAddress -> seleccionarClienteDomiciliosAjax();
    }
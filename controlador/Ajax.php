<?php 
    require_once '../modelo/CRUD.php';
    require_once '../modelo/CRUDCliente.php';
    require_once '../modelo/CRUDUsuario.php';
    require_once '../modelo/CRUDMascota.php';
    require_once 'Controlador.php';
    require_once 'ControladorCliente.php';
    require_once 'ControladorUsuario.php';
    require_once 'ControladorMascota.php';

    class Ajax{
        public $usuarioElegido;
        public $clienteElegido;
        public $clientesElegidosEliminar;
        public $usuariosElegidosEliminar;
        public $correosClienteEliminar;
        public $telefonosClienteEliminar;
        public $domiciliosClienteEliminar;
        
        
        public $requestClientEdit;
        public $requestUserEdit;
        public $requestClientDataEdit;
        
        public $grafica;
        public $selectRaza;

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
            echo $respuesta;
        }
        
        #Deshabilitar uno o más correos de clientes.
        public function eliminarCorreosClienteAjax(){
            $datos = $this -> correosClienteEliminar;
            $respuesta = ControladorCliente::eliminarCorreosClienteCtl($datos);
            echo $respuesta;
        }
        
        #Deshabilitar uno o más teléfonos de clientes.
        public function eliminarTelefonosClienteAjax(){
            $datos = $this -> telefonosClienteEliminar;
            $respuesta = ControladorCliente::eliminarTelefonosClienteCtl($datos);
            echo $respuesta;
        }
        
        #Deshabilitar uno o más domicilios de clientes.
        public function eliminarDomiciliosClienteAjax(){
            $datos = $this -> domiciliosClienteEliminar;
            $respuesta = ControladorCliente::eliminarDomiciliosClienteCtl($datos);
            echo $respuesta;
        }
        
        #Deshabilitar uno o más usuarios.
        public function eliminarUsuariosAjax(){
            $datos = $this -> usuariosElegidosEliminar;
            $respuesta = ControladorUsuario::eliminarUsuariosCtl($datos);
            echo json_encode($respuesta);
        }

        #Seleccionar correo electrónico del cliente para editar.
        public function seleccionarClienteCorreoAjax(){
            $requestCD = $this -> requestClientDataEdit;
            $respuesta = ControladorCliente::seleccionarClienteCorreoCtl($requestCD);
            echo json_encode($respuesta);
        }
        
        #Seleccionar teléfono del cliente para editar.
        public function seleccionarClienteTelefonoAjax(){
            $requestCD = $this -> requestClientDataEdit;
            $respuesta = ControladorCliente::seleccionarClienteTelefonoCtl($requestCD);
            echo json_encode($respuesta);
        }
        
        #Seleccionar domicilio del cliente para editar.
        public function seleccionarClienteDomicilioAjax(){
            $requestCD = $this -> requestClientDataEdit;
            $respuesta = ControladorCliente::seleccionarClienteDomicilioCtl($requestCD);
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
        
        #Seleccionar los atributos de la mascota.
        public function seleccionarAtributosAjax(){
            $requestCD = $this -> grafica;
            $respuesta = ControladorMascota::seleccionarAtributosCtl($requestCD);
            echo json_encode($respuesta);
        }
        
        #Seleccionar las razas de la especie obtenida.
        public function seleccionarRazasByEspecieAjax(){
            $requestCD = $this -> selectRaza;
            $respuesta = ControladorMascota::seleccionarRazasByEspecieCtl($requestCD);
            echo json_encode($respuesta);
        }
    }
    
    if (isset($_POST["clientsToDelete"])) {
        $objIdEliminar = new Ajax();
        $objIdEliminar -> clientesElegidosEliminar = json_decode($_POST["clientsToDelete"]);
        $objIdEliminar -> eliminarClientesAjax();
    }
    
    if (isset($_POST["usersToDelete"])) {
        $objIdEliminar = new Ajax();
        $objIdEliminar -> usuariosElegidosEliminar = json_decode($_POST["usersToDelete"]);
        $objIdEliminar -> eliminarUsuariosAjax();
    }
    
    if (isset($_POST["emailsClientToDelete"])) {
        $objIdEliminar = new Ajax();
        $objIdEliminar -> correosClienteEliminar = json_decode($_POST["emailsClientToDelete"]);
        $objIdEliminar -> eliminarCorreosClienteAjax();
    }
    
    if (isset($_POST["phonesClientToDelete"])) {
        $objIdEliminar = new Ajax();
        $objIdEliminar -> telefonosClienteEliminar = json_decode($_POST["phonesClientToDelete"]);
        $objIdEliminar -> eliminarTelefonosClienteAjax();
    }
    
    if (isset($_POST["addressClientToDelete"])) {
        $objIdEliminar = new Ajax();
        $objIdEliminar -> domiciliosClienteEliminar = json_decode($_POST["addressClientToDelete"]);
        $objIdEliminar -> eliminarDomiciliosClienteAjax();
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
    
    if (isset($_POST["client-edit-phone-id"])) {
        $objRequestClientDataEdit = new Ajax();
        $objRequestClientDataEdit -> requestClientDataEdit = $_POST["client-edit-phone-id"];
        $objRequestClientDataEdit -> seleccionarClienteTelefonoAjax();
    }
    
    if (isset($_POST["client-edit-address-id"])) {
        $objRequestClientDataEdit = new Ajax();
        $objRequestClientDataEdit -> requestClientDataEdit = $_POST["client-edit-address-id"];
        $objRequestClientDataEdit -> seleccionarClienteDomicilioAjax();
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
    
    if (isset($_POST["graficaMascota"])) {
        $objGrafica = new Ajax();
        $objGrafica -> grafica = $_POST["graficaMascota"];
        $objGrafica -> seleccionarAtributosAjax();
    }
    
    if (isset($_POST["select-raza"])) {
        $objSelectRaza = new Ajax();
        $objSelectRaza -> selectRaza = $_POST["select-raza"];
        $objSelectRaza -> seleccionarRazasByEspecieAjax();
    }
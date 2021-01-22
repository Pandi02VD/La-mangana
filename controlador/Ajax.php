<?php 
    require_once '../modelo/CRUD.php';
    require_once 'Controlador.php';

    class Ajax{
        public $usuarioElegido;
        public $clienteElegido;

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
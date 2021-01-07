<?php
    class Controlador{
        public function plantilla(){
            include 'vista/Plantilla.php';
        }
        
        public function traerPaginaCtl(){
            if (isset($_GET["pagina"])) {
                $pagina = $_GET["pagina"];
            }else{
                $pagina = "index";
            }
            $respuesta = Pagina::traerPagina($pagina);
            include $respuesta;
        }

        public function seleccionarUsuariosCtl(){
            $respuesta = CRUD::seleccionarUsuariosMdl();
            return $respuesta;
        }
    }
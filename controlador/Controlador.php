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

        #Seleccionar los usuarios 
        public function seleccionarUsuariosCtl(){
            $respuesta = CRUD::seleccionarUsuariosBD();
            return $respuesta;
        }

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
                    }elseif ($datosUsuario["iduser"] == $respuesta["iduser"]) {
                        $_SESSION["ingresado"] = $datosUsuario["nombre"];
                        $_SESSION["usuario"] = $datosUsuario["iduser"];
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

        public function conectarUsuarioCtl($usuario){
            $conectar = CRUD::conectarUsuarioBD($usuario);
            return $conectar;
        }
        
        public function desconectarUsuarioCtl($usuario){
            $desconectar = CRUD::desconectarUsuarioBD($usuario);
            return $desconectar;
        }
    }
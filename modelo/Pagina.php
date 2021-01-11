<?php
    class Pagina{
        public function traerPagina($modulo){
            if($modulo == "Inicio" || $modulo == "IniciarSesion" || $modulo == "Navegacion" || $modulo == "Salir"){
                $directorio = "vista/modulo/".$modulo.".php";
            }else{
                $directorio = "vista/modulo/Inicio.php";
            }
            return $directorio;
        }
    }
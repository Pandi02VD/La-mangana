<?php
    class Pagina{
        public function traerPagina($modulo){
            if(
                $modulo == "Inicio" || $modulo == "IniciarSesion" || 
                $modulo == "Usuarios" || $modulo == "Salir" || 
                $modulo == "CrearCuenta" || $modulo == "CrearCliente" || 
                $modulo == "MascotasUsuario" || $modulo == "Mascotas" || 
                $modulo == "Error"
            ){
                $directorio = "vista/modulo/".$modulo.".php";
            }else{
                $directorio = "vista/modulo/Inicio.php";
            }
            return $directorio;
        }
    }
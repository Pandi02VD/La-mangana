<?php
    class Pagina{
        public function traerPagina($modulo){
            if(
                $modulo == "Inicio" || $modulo == "IniciarSesion" || 
                $modulo == "Usuarios" || $modulo == "Clientes" || 
                $modulo == "MascotasCliente" || $modulo == "Mascotas" || 
                $modulo == "Salir" || $modulo == "HistoriaClinica" || 
                $modulo == "Error"
            ){
                $directorio = "vista/modulo/".$modulo.".php";
            }else{
                $directorio = "vista/modulo/Inicio.php";
            }
            return $directorio;
        }
    }
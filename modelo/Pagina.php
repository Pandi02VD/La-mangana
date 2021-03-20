<?php
    class Pagina{
        public function traerPagina($modulo){
            if(
                $modulo == "Inicio" || 
                $modulo == "IniciarSesion" || 
                $modulo == "Usuarios" || $modulo == "Usuario" || 
                $modulo == "Clientes" || $modulo == "Cliente" || 
                $modulo == "MascotasCliente" || $modulo == "Mascotas" || $modulo == "Mascota" || 
                $modulo == "HistoriaClinica" || 
                $modulo == "Salir" || 
                $modulo == "Error"
            ){
                $directorio = "vista/modulo/".$modulo.".php";
            }else{
                $directorio = "vista/modulo/Inicio.php";
            }
            return $directorio;
        }
    }
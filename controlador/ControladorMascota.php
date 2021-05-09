<?php
    class ControladorMascota{
        #Seleccionar las mascotas del cliente.
        public function mascotasClienteCtl($clienteId){
            $respuesta = CRUDMascota::mascotasClienteBD($clienteId);
            return $respuesta;
        }

        #Seleccionar raza de mascota 
        public function seleccionarRazaMascotaCtl($razaId){
            $respuesta = CRUDMascota::seleccionarRazaMascotaBD($razaId);
            return $respuesta;
        }
    }
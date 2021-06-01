<?php
    class ControladorMascota{
        #Agregar nueva mascota de cliente.
        public function nuevaMascotaCtl(){
            if (
                isset($_POST["pet-nombre-new"]) && 
                isset($_POST["pet-property-new"]) && 
                isset($_POST["pet-especie-new"]) && 
                isset($_POST["pet-raza-new"]) && 
                isset($_POST["pet-sexo-new"]) && 
                isset($_POST["pet-edad-new"]) && 
                isset($_POST["pet-peso-new"]) && 
                isset($_POST["pet-tamano-new"]) && 
                isset($_POST["pet-cuerpo-new"])
            ) {
                $datosMascota = array(
                    "nombre" => $_POST["pet-nombre-new"], 
                    "propietarioId" => $_POST["pet-property-new"], 
                    "raza" => $_POST["pet-raza-new"], 
                    "sexo" => $_POST["pet-sexo-new"], 
                    "edad" => $_POST["pet-edad-new"]
                );

                $mascotaRegistrada = CRUDMascota::nuevaMascotaBD($datosMascota);
                $idmascota;
                if($mascotaRegistrada != null) { 
                    $idmascota = $mascotaRegistrada["id"];
                    $atributos = array(
                        "mascotaId" => $idmascota, 
                        "peso" => $_POST["pet-peso-new"], 
                        "tamano" => $_POST["pet-tamano-new"], 
                        "cuerpo" => $_POST["pet-cuerpo-new"]
                    );
                    $atributosMascota = CRUDMascota::nuevosAtributosBD($atributos);
                    if ($atributosMascota) {
                        echo '
                        <script>
                            alert("Mascota agregada correctamente");
                            window.location = "index.php?pagina=MascotasCliente&vru=' . $datosMascota["propietarioId"] . '";
                        </script>
                        ';
                    } else {
                        echo '
                        <script>
                            alert("Mascota no agregada");
                            window.location = "index.php?pagina=MascotasCliente&vru=' . $datosMascota["propietarioId"] . '";
                        </script>
                        ';
                    }
                } else {
                    echo '
                        <script>
                            alert("Mascota no agregada");
                            window.location = "index.php?pagina=MascotasCliente&vru=' . $datosMascota["propietarioId"] . '";
                        </script>
                        ';
                }
            }
        }

        #Seleccionar atributos de mascota para la gráfica.
        public function seleccionarAtributosCtl($mascotaId){
            $respuesta = CRUDMascota::seleccionarAtributosBD($mascotaId);
            return $respuesta;
        }
        
        #Seleccionar todas las mascotas.
        public function seleccionarMascotasCtl(){
            $respuesta = CRUDMascota::seleccionarMascotasBD();
            return $respuesta;
        }
        
        #Seleccionar una mascota.
        public function seleccionarMascotaCtl($mascotaId){
            $respuesta = CRUDMascota::seleccionarMascotaBD($mascotaId);
            return $respuesta;
        }

        #Seleccionar las especies.
        public function seleccionarEspeciesCtl(){
            $respuesta = CRUDMascota::seleccionarEspeciesBD();
            return $respuesta;
        }
        
        #Seleccionar las razas por especie.
        public function seleccionarRazasByEspecieCtl($especieId){
            $respuesta = CRUDMascota::seleccionarRazasByEspecieBD($especieId);
            return $respuesta;
        }

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
<?php 
    $mascotas = ControladorMascota::seleccionarMascotasCtl();
?>

<div class="title">
    <h2>Mascotas</h2>
</div>

<div class="C__Table">
    <?php if ($mascotas == null) { ?>
        <div class="C__Btn">
            <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
            <span class="tooltip">Agregar mascota</span>
        </div>
        <div class="nodata"><span>Aún no hay registros</span></div>
        <div class="C__f oculto" id="form-add-pet">
            <form method="post" class="f">
                <input class="f__close" type="button" id="btn-close-form-add-pet" value="x">
                <h2 class="f__title">Nueva Mascota</h2>
                <div class="line-top"></div>
                <div class="i__group">
                    <label class="labels" for="pet-nombre-new">Nombre</label>
                    <input class="inputs" type="text" id="pet-nombre-new" name="pet-nombre-new">
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Especie</label>
                    <label class="label-checkbox" for="pet-canino-new">Canino</label>
                    <input type="radio" name="pet-especie-new" id="pet-canino-new">
                    <label class="label-checkbox" for="pet-felino-new">Felino</label>
                    <input type="radio" name="pet-especie-new" id="pet-felino-new">
                </div>

                <div class="i__group">
                    <label class="label-checkbox" for="pet-raza-new">Raza</label>
                    <select name="pet-raza-new" id="pet-raza-new">
                        <option value="">Seleccione la raza</option>
                        <option value="1">Chachanete</option>
                        <option value="2">Pastor Alemán</option>
                    </select>
                </div>
                
                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Sexo</label>
                    <label class="label-checkbox" for="pet-hembra-new">Hembra</label>
                    <input type="radio" name="pet-sexo-new" id="pet-hembra-new">
                    <label class="label-checkbox" for="pet-macho">Macho</label>
                    <input type="radio" name="pet-sexo-new" id="pet-macho-new">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-edad-new">Edad (años)</label>
                    <input class="inputs" type="number" id="pet-edad-new" name="pet-edad-new">
                </div>
                
                <div class="i__group">
                    <label class="label-checkbox" for="pet-cuerpo-new">Condición corporal</label>
                    <select name="pet-cuerpo-new" id="pet-cuerpo-new">
                        <option value="">Seleccione la condición corporal</option>
                        <option value="1">Delgado</option>
                        <option value="2">Normal</option>
                        <option value="2">Robusto</option>
                    </select>
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Tamaño</label>
                    <label class="label-checkbox" for="pet-chico-new">Chico</label>
                    <input type="radio" name="pet-tamano-new" id="pet-chico-new">
                    <label class="label-checkbox" for="pet-mediano-new">Mediano</label>
                    <input type="radio" name="pet-tamano-new" id="pet-mediano-new">
                    <label class="label-checkbox" for="pet-grande-new">Grande</label>
                    <input type="radio" name="pet-tamano-new" id="pet-grande-new">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-color-new">Color</label>
                    <input class="inputs" type="color" id="pet-color-new" name="pet-color-new">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-peso-new">Peso (Kg)</label>
                    <input class="inputs" type="number" id="pet-peso-new" name="pet-peso-new">
                </div>
                
                <input class="submit" type="submit" value="Crear">
                <?php 
                    // $crearUsuario = ControladorUsuario::crearCuentaCtl();
                ?>
            </form>

        </div>
    <?php }else{ ?>
        <div class="Bar__Btns">
            <div class="C__Btn">
                <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
                <span class="tooltip">Agregar mascota</span>
            </div>
            <div class="C__Btn">
                <input type="image" src="img/stethoscope_32px.png" alt="imágen de acción" id="btn-add-Consult-pet" disabled>
                <span class="tooltip">Consulta</span>
            </div>
            <div class="C__Btn">
                <input type="image" src="img/edit_32px.png" alt="imágen de acción"  id="btn-edit-pet" disabled>
                <span class="tooltip">Editar información de mascota</span>
            </div>
            <div class="C__Btn">
                <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-pet" disabled>
                <span class="tooltip">Borrar mascota</span>
            </div>
            <div class="C__Btn">
                <a href="index.php?pagina=HistoriaClinica">
                    <input type="image" src="img/treatment_32px.png" alt="imágen de acción" id="btn-see-HC-pet" disabled>
                </a>
                <span class="tooltip">Ver historial clínico</span>
            </div>
            <div class="C__Btn__Last">
                <a href="#search-pet"><image src="img/search_32px.png"></image></a>
                <input class="inputs" type="text" id="search-pet" name="search-pet" placeholder="Buscar mascota">
            </div>
        </div>

        <table class="table" id="tbl-mascotas-cliente">
            <tr>
                <th><input type="checkbox" name="check-all-pets" id="check-all-pets"></th>
                <th>Propietario</th>
                <th>Nombre</th>
                <th>Raza</th>
                <th>Sexo</th>
                <th>Edad (años)</th>
            </tr>
                <?php foreach($mascotas as $key => $value) : ?>
                <?php 
                    $raza = ControladorMascota::seleccionarRazaMascotaCtl($value["idmascota_raza"]);
                    $currentYear = date("Y");
                    
                    switch($value["sexo"]){
                        case 1: $sexo = "Hembra"; break;
                        case 2: $sexo = "Macho"; break;
                    }
                    
                    // switch($value["condicion_corporal"]){
                    //     case 1: $cuerpo = "Delgado"; break;
                    //     case 2: $cuerpo = "Normal"; break;
                    //     case 3: $cuerpo = "Robusto"; break;
                    // }
                    
                    // switch($value["tamano"]){
                    //     case 1: $tamano = "Chico"; break;
                    //     case 2: $tamano = "Mediano"; break;
                    //     case 2: $tamano = "Grande"; break;
                    // }
                ?>
            <tr>
                <td><input type="checkbox" name="check-pet" id="check-pet<?=$value["idmascota"]?>" value="<?=$value["idmascota"]?>"></td>
                <td id="<?=$value["idmascota"]?>" name="pets-table"><?=$value["cliente"]?></td>
                <td id="<?=$value["idmascota"]?>" name="pets-table"><?=$value["mascota"]?></td>
                <td id="<?=$value["idmascota"]?>" name="pets-table"><?=$raza["raza"]?></td>
                <td id="<?=$value["idmascota"]?>" name="pets-table"><?=$sexo?></td>
                <td id="<?=$value["idmascota"]?>" name="pets-table"><?=$currentYear - $value["ano_nacimiento"]?></td>
            </tr>
                <?php endforeach ?>
        </table>

        <div class="C__f oculto" id="form-add-pet">
            <form method="post" class="f">
                <input class="f__close" type="button" id="btn-close-form-add-pet" value="x">
                <h2 class="f__title">Nueva Mascota</h2>
                <div class="line-top"></div>
                <div class="i__group">
                    <label class="labels" for="pet-nombre-new">Nombre</label>
                    <input class="inputs" type="text" id="pet-nombre-new" name="pet-nombre-new">
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Especie</label>
                    <label class="label-checkbox" for="pet-canino-new">Canino</label>
                    <input type="radio" name="pet-especie-new" id="pet-canino-new">
                    <label class="label-checkbox" for="pet-felino-new">Felino</label>
                    <input type="radio" name="pet-especie-new" id="pet-felino-new">
                </div>

                <div class="i__group">
                    <label class="label-checkbox" for="pet-raza-new">Raza</label>
                    <select name="pet-raza-new" id="pet-raza-new">
                        <option value="">Seleccione la raza</option>
                        <option value="1">Chachanete</option>
                        <option value="2">Pastor Alemán</option>
                    </select>
                </div>
                
                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Sexo</label>
                    <label class="label-checkbox" for="pet-hembra-new">Hembra</label>
                    <input type="radio" name="pet-sexo-new" id="pet-hembra-new">
                    <label class="label-checkbox" for="pet-macho">Macho</label>
                    <input type="radio" name="pet-sexo-new" id="pet-macho-new">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-edad-new">Edad (años)</label>
                    <input class="inputs" type="number" id="pet-edad-new" name="pet-edad-new">
                </div>
                
                <div class="i__group">
                    <label class="label-checkbox" for="pet-cuerpo-new">Condición corporal</label>
                    <select name="pet-cuerpo-new" id="pet-cuerpo-new">
                        <option value="">Seleccione la condición corporal</option>
                        <option value="1">Delgado</option>
                        <option value="2">Normal</option>
                        <option value="2">Robusto</option>
                    </select>
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Tamaño</label>
                    <label class="label-checkbox" for="pet-chico-new">Chico</label>
                    <input type="radio" name="pet-tamano-new" id="pet-chico-new">
                    <label class="label-checkbox" for="pet-mediano-new">Mediano</label>
                    <input type="radio" name="pet-tamano-new" id="pet-mediano-new">
                    <label class="label-checkbox" for="pet-grande-new">Grande</label>
                    <input type="radio" name="pet-tamano-new" id="pet-grande-new">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-color-new">Color</label>
                    <input class="inputs" type="color" id="pet-color-new" name="pet-color-new">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-peso-new">Peso (Kg)</label>
                    <input class="inputs" type="number" id="pet-peso-new" name="pet-peso-new">
                </div>
                
                <input class="submit" type="submit" value="Crear">
                <?php 
                    // $crearUsuario = ControladorUsuario::crearCuentaCtl();
                ?>
            </form>
        </div>
        
        <div class="C__f oculto" id="form-add-Consult-pet">
            <form method="post" class="f">
                <input class="f__close" type="button" id="btn-close-form-add-Consult-pet" value="x">
                <h2 class="f__title">Registro de consulta</h2>
                <div class="line-top"></div>
                <div class="f__datetime">
                    <span>Folio. #12345678</span>
                    <span>Fecha: 24/10/2021 </span>
                </div>
                <div class="tabs">
                    <a href="#tab-mascota">Datos de la Mascota</a>
                    <a href="#tab-propietario">Datos del dueño</a>
                </div>
                <div name="tabs-content">
                    <div id="tab-mascota" class="ficha__info">
                        <table id="table">
                            <tr><td>Nombre: </td><td>Laica</td></tr>
                            <tr><td>Raza: </td><td>Pastor Alemán</td></tr>
                            <tr><td>Sexo: </td><td>Hembra</td></tr>
                            <tr><td>Edad: </td><td>13 años</td></tr>
                            <tr><td>Condición corporal: </td><td>Normal</td></tr>
                            <tr><td>Tamaño: </td><td>Mediano</td></tr>
                            <tr><td>Peso: </td><td>13.700 Kg.</td></tr>
                        </table>
                    </div>
                    
                    <div id="tab-propietario" class="ficha__info">
                        <table id="table">
                            <tr><td>Nombre: </td><td>José Lameiras</td></tr>
                            <tr><td>Teléfono: </td><td>1112223344</td></tr>
                            <tr><td>Domicilio: </td><td>Colonia Centro, Calle I. Allende</td></tr>
                        </table>
                    </div>
                </div>
                
                <div class="i__group">
                    <label class="label-checkbox" for="pet-service-H">Servicio post-consulta</label>
                    <div>
                        <div id="checkbox">
                            <input class="none" type="checkbox" name="pet-service-H" id="pet-service-H">
                            <label for="pet-service-H">Hospitalización</label>
                        </div>
                        <div id="checkbox">
                            <input class="none" type="checkbox" name="pet-service-C" id="pet-service-C">
                            <label for="pet-service-C">Cirugía</label>
                        </div>
                        <div id="checkbox">
                            <input class="none" type="checkbox" name="pet-service-V" id="pet-service-V">
                            <label for="pet-service-V">Vacunación</label>
                        </div>
                    </div>
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox" for="pet-Consult-observaciones">Observaciones</label>
                    <input class="inputs" type="text" name="pet-Consult-observaciones" id="pet-Consult-observaciones">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-Consult-costo">Costo ($ MNX)</label>
                    <input class="inputs" type="number" id="pet-Consult-costo" name="pet-Consult-costo">
                </div>
                
                <!-- <input class="submit" type="button" value="Siguiente paso" id=""> -->
                <a href="#form-add-H-pet" id="btn-first" class="submit">Siguiente paso</a>
                <?php 
                    // $crearUsuario = ControladorUsuario::crearCuentaCtl();
                ?>
            </form>
        </div>

        <div class="C__f oculto" id="form-edit-pet">
            <form method="post" class="f">
                <input class="f__close" type="button" id="btn-close-form-edit-pet" value="x">
                <h2 class="f__title">Editar Mascota</h2>
                <div class="line-top"></div>
                <div class="i__group">
                    <label class="labels" for="pet-nombre-edit">Nombre</label>
                    <input class="inputs" type="text" id="pet-nombre-edit" name="pet-nombre-edit">
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Especie</label>
                    <label class="label-checkbox" for="pet-canino-edit">Canino</label>
                    <input type="radio" name="pet-especie-edit" id="pet-canino-edit">
                    <label class="label-checkbox" for="pet-felino-edit">Felino</label>
                    <input type="radio" name="pet-especie-edit" id="pet-felino-edit">
                </div>

                <div class="i__group">
                    <label class="label-checkbox" for="pet-raza-edit">Raza</label>
                    <select name="pet-raza-edit" id="pet-raza-edit">
                        <option value="">Seleccione la raza</option>
                        <option value="1">Chachanete</option>
                        <option value="2">Pastor Alemán</option>
                    </select>
                </div>
                
                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Sexo</label>
                    <label class="label-checkbox" for="pet-hembra-edit">Hembra</label>
                    <input type="radio" name="pet-sexo-edit" id="pet-hembra-edit">
                    <label class="label-checkbox" for="pet-macho">Macho</label>
                    <input type="radio" name="pet-sexo-edit" id="pet-macho-edit">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-edad-edit">Edad (años)</label>
                    <input class="inputs" type="number" id="pet-edad-edit" name="pet-edad-edit">
                </div>
                
                <div class="i__group">
                    <label class="label-checkbox" for="pet-cuerpo-edit">Condición corporal</label>
                    <select name="pet-cuerpo-edit" id="pet-cuerpo-edit">
                        <option value="">Seleccione la condición corporal</option>
                        <option value="1">Delgado</option>
                        <option value="2">Normal</option>
                        <option value="2">Robusto</option>
                    </select>
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox">Tamaño</label>
                    <label class="label-checkbox" for="pet-chico-edit">Chico</label>
                    <input type="radio" name="pet-tamano-edit" id="pet-chico-edit">
                    <label class="label-checkbox" for="pet-mediano-edit">Mediano</label>
                    <input type="radio" name="pet-tamano-edit" id="pet-mediano-edit">
                    <label class="label-checkbox" for="pet-grande-edit">Grande</label>
                    <input type="radio" name="pet-tamano-edit" id="pet-grande-edit">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-color-edit">Color</label>
                    <input class="inputs" type="color" id="pet-color-edit" name="pet-color-edit">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-peso-edit">Peso (Kg)</label>
                    <input class="inputs" type="number" id="pet-peso-edit" name="pet-peso-edit">
                </div>
                
                <input class="submit" type="submit" value="Crear">
                <input type="hidden" name="mascotaId-edit" id="mascotaId-edit">
                <?php 
                    // $crearUsuario = ControladorUsuario::crearCuentaCtl();
                ?>
            </form>

        </div>

        <div class="C__f oculto" id="form-delete-pet">
            <form method="post" class="f">
                <input class="f__close" type="button" id="btn-close-form-delete-pet" value="x">
                <h2 class="f__title">Confirmación</h2>
                <div class="line-top"></div>
                <span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
                <div class="D-info">
                    <p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
                </div>
                <input class="submit" type="submit" value="Confirmar">
                <?php 
                    // $actualizaUsuario = ControladorUsuario::actualizarUsuarioCtl();
                ?>
            </form>
        </div>

        <div class="C__f oculto" id="form-add-H-pet">
            <form method="post" class="f">
                <!-- <input class="f__close" type="button" id="btn-close-form-add-H-pet" value="x"> -->
                <a class="back" href="#form-add-Consult-pet" id="btn-return-to-first"><img src="img/back_26px.png" alt="img-regresar"> Regresar</a>
                <h2 class="f__title">Orden de Hospitalización</h2>
                <div class="line-top"></div>
                <div class="tabs">
                    <a href="#tab-consulta-H">Datos de consulta</a>
                    <a href="#tab-mascota-H">Datos de la Mascota</a>
                    <a href="#tab-propietario-H">Datos del dueño</a>
                </div>
                <div name="tabs-content">
                    <div id="tab-consulta-H" class="ficha__info">
                        <table id="table">
                            <caption>Folio: #1234567</caption>
                            <tr><td>Inicio: </td><td>12/02/2021 12:09 p. m.</td></tr>
                            <tr><td>Fin: </td><td>12/02/2021 12:22 p. m.</td></tr>
                            <tr><td>Observaciones: </td><td>Bla bla bla</td></tr>
                        </table>
                    </div>

                    <div id="tab-mascota-H" class="ficha__info">
                        <table id="table">
                            <tr><td>Nombre: </td><td>Laica</td></tr>
                            <tr><td>Raza: </td><td>Pastor Alemán</td></tr>
                            <tr><td>Sexo: </td><td>Hembra</td></tr>
                            <tr><td>Edad: </td><td>13 años</td></tr>
                            <tr><td>Condición corporal: </td><td>Normal</td></tr>
                            <tr><td>Tamaño: </td><td>Mediano</td></tr>
                            <tr><td>Peso: </td><td>13.700 Kg.</td></tr>
                        </table>
                    </div>
                    
                    <div id="tab-propietario-H" class="ficha__info">
                        <table id="table">
                            <tr><td>Nombre: </td><td>José Lameiras</td></tr>
                            <tr><td>Teléfono: </td><td>1112223344</td></tr>
                            <tr><td>Domicilio: </td><td>Colonia Centro, Calle I. Allende</td></tr>
                        </table>
                    </div>
                </div>

                <div class="C__group">
                    <h4>Programar Hospitalización</h4>
                    <div class="line-top"></div>
                    <div class="i__group m-no">
                        <label class="label-checkbox" for="pet-H-entrada">Entrada</label>
                        <input class="inputs" type="datetime-local" name="pet-H-entrada" id="pet-H-entrada">
                    </div>
                    <div class="i__group">
                        <label class="label-checkbox" for="pet-H-salida">Salida</label>
                        <input class="inputs" type="datetime-local" name="pet-H-salida" id="pet-H-salida">
                    </div>
                </div>
                
                <div class="i__group">
                    <label class="label-checkbox" for="pet-H-jaula">Número de Jaula</label>
                    <select name="pet-H-jaula" id="pet-H-jaula">
                        <option value="">Seleccione la jaula</option>
                        <option class="option-free" value="1">1 Libre</option>
                        <option class="option-booked" value="2" disabled>2 Ocupado</option>
                        <option class="option-free" value="2">3 Libre</option>
                    </select>
                </div>

                <div class="i__group">
                    <label class="i-b w100 label-checkbox" for="pet-H-motivo">Motivo de Hospitalización</label>
                    <input class="inputs" type="text" name="pet-H-motivo" id="pet-H-motivo">
                </div>

                <div class="i__group">
                    <label class="labels" for="pet-H-costo">Costo ($ MNX)</label>
                    <input class="inputs" type="number" id="pet-H-costo" name="pet-H-costo">
                </div>
                
                <input class="submit" type="submit" value="Guardar orden">
                <?php 
                    // $crearUsuario = ControladorUsuario::crearCuentaCtl();
                ?>
            </form>
        </div>
    <?php } ?>
</div>
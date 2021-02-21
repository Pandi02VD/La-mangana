<?php 
    if (!isset($_GET["vru"])) {
        echo '<script>window.location = "index.php?pagina=Error";</script>';
    }
    $clienteId = $_GET["vru"];
    $cliente = Controlador::seleccionarClienteCtl($clienteId);
    $mascotasCliente = Controlador::mascotasClienteCtl($clienteId);
?>
<h2>Mascotas de <?= $cliente["nombre"] == null ? '<script>window.location = "index.php?pagina=Error";</script>' : $cliente["nombre"] ;?></h2>

<div class="C__Table">
    <h3>Mascotas</h3>
    <?php if ($mascotasCliente == null) { ?>
    <div class="C__Btn">
        <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
        <span class="tooltip">Agregar mascota</span>
    </div>
    <div class="nodata"><span>Aún no hay registros</span></div>
    <div class="C__f oculto" id="form-add-pet">
        <button class="f__close" id="btn-close-form-add-pet">X</button>

        <form method="post" class="f">
        <h2 class="f__title">Nueva Mascota de <?=$cliente["nombre"]?></h2>
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
            // $crearUsuario = Controlador::crearCuentaCtl();
        ?>
        </form>

    </div>
    <?php }else{ ?>
    <!-- <div> -->
    <div class="C__Btn">
        <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
        <span class="tooltip">Agregar mascota</span>
    </div>
    <div class="C__Btn">
        <input type="image" src="img/edit_32px.png" alt="imágen de acción"  id="btn-edit-pet" disabled>
        <span class="tooltip">Editar información de mascota</span>
    </div>
    <div class="C__Btn">
        <input type="image" src="img/waste_32px.png" alt="imágen de acción" id="btn-delete-pet" disabled>
        <span class="tooltip">Borrar mascota</span>
    </div>
    <div class="C__Btn">
        <input type="image" src="img/ambulance_32px.png" alt="imágen de acción" id="btn-add-H-pet" disabled>
        <span class="tooltip">Hospitalizar mascota</span>
    </div>
    <div class="C__Btn">
        <input type="image" src="img/poodle_32px.png" alt="imágen de acción" id="btn-add-E-pet" disabled>
        <span class="tooltip">Estilizar mascota</span>
    </div>
    <div class="C__Btn">
        <a href="index.php?pagina=HistoriaClinica">
            <input type="image" src="img/task_planning_32px.png" alt="imágen de acción" id="btn-add-HC-pet" disabled>
        </a>
        <span class="tooltip">Ver historial clínico</span>
    </div>

    <table id="table">
        <tr>
            <th><input type="checkbox" name="check-all-pets" id="check-all-pets"></th>
            <th>Nombre</th>
            <th>Raza</th>
            <th>Sexo</th>
            <th>Edad (años)</th>
            <th>Condicion corporal</th>
            <th>Tamaño</th>
            <th>Peso (Kg.)</th>
        </tr>
            <?php foreach($mascotasCliente as $key => $value) : ?>
            <?php 
                $raza = Controlador::seleccionarRazaMascotaCtl($value["idmascota_raza"]);
                $currentYear = date("Y");
                
                switch($value["sexo"]){
                    case 1: $sexo = "Hembra"; break;
                    case 2: $sexo = "Macho"; break;
                }
                
                switch($value["condicion_corporal"]){
                    case 1: $cuerpo = "Delgado"; break;
                    case 2: $cuerpo = "Normal"; break;
                    case 3: $cuerpo = "Robusto"; break;
                }
                
                switch($value["tamano"]){
                    case 1: $tamano = "Chico"; break;
                    case 2: $tamano = "Mediano"; break;
                    case 2: $tamano = "Grande"; break;
                }
            ?>
        <tr>
            <td><input type="checkbox" name="check-pet" id="check-pet<?=$value["idmascota"]?>" value="<?=$value["idmascota"]?>"></td>
            <td><?=$value["mascota"]?></td>
            <td><?=$raza["raza"]?></td>
            <td><?=$sexo?></td>
            <td><?=$currentYear - $value["ano_nacimiento"]?></td>
            <td><?=$cuerpo?></td>
            <td><?=$tamano?></td>
            <td><?=$value["peso"]?></td>
        </tr>
            <?php endforeach ?>
    </table>

    <div class="C__f oculto" id="form-add-pet">
        <button class="f__close" id="btn-close-form-add-pet">X</button>

        <form method="post" class="f">
        <h2 class="f__title">Nueva Mascota de <?=$cliente["nombre"]?></h2>
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
            // $crearUsuario = Controlador::crearCuentaCtl();
        ?>
        </form>

    </div>

    <div class="C__f oculto" id="form-edit-pet">
        <button class="f__close" id="btn-close-form-edit-pet">X</button>

        <form method="post" class="f">
        <h2 class="f__title">Editar Mascota de <?=$cliente["nombre"]?></h2>
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
            // $crearUsuario = Controlador::crearCuentaCtl();
        ?>
        </form>

    </div>

    <div class="C__f oculto" id="form-delete-pet">
        <button class="f__close" id="btn-close-form-delete-pet">X</button>
        <form method="post" class="f">
            <h2 class="f__title">Confirmación</h2>
            <div class="line-top"></div>
            <span class="label-checkbox">¿Desea eliminar el registro?</span>
            
            <input class="submit" type="submit" value="Confirmar">
            <?php 
                // $actualizaUsuario = Controlador::actualizarUsuarioCtl();
            ?>
        </form>
    </div>

    <div class="C__f oculto" id="form-add-H-pet">
        <button class="f__close" id="btn-close-form-add-H-pet">X</button>

        <form method="post" class="f">
        <h2 class="f__title">Orden de Hospitalización</h2>
        <div class="line-top"></div>
        <div class="tabs">
            <a href="#tab-consulta">Datos de consulta</a>
            <a href="#tab-mascota">Datos de la Mascota</a>
            <a href="#tab-propietario">Datos del dueño</a>
        </div>
        <div id="tabs-content">
            <div id="tab-consulta" class="ficha__info">
                <table id="table">
                    <caption>Folio: #1234567</caption>
                    <tr><td>Inicio: </td><td>12/02/2021 12:09 p. m.</td></tr>
                    <tr><td>Fin: </td><td>12/02/2021 12:22 p. m.</td></tr>
                    <tr><td>Observaciones: </td><td>Bla bla bla</td></tr>
                </table>
            </div>

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
            // $crearUsuario = Controlador::crearCuentaCtl();
        ?>
        </form>
    </div>

    <!-- <div class="C__f oculto" id="form-add-pet">
        <button class="f__close" id="btn-close-form-add-pet">X</button>

        <form method="post" class="f">
        <h2 class="f__title">Nueva Mascota de <?=$cliente["nombre"]?></h2>
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
            // $crearUsuario = Controlador::crearCuentaCtl();
        ?>
        </form>

    </div> -->
    <?php } ?>
</div>
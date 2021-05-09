<?php 
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        if (!isset($_GET["Cliente"]) && !isset($_GET["uc"])) {
            echo '<script>window.location = "index.php?pagina=Error"</script>';
        }
    }

    $cliente = ControladorCliente::datosClienteCtl($_GET["uc"]);
    $clienteCorreos = ControladorCliente::seleccionarClienteCorreosCtl($_GET["uc"]);
    $clienteTelefonos = ControladorCliente::seleccionarClienteTelefonosCtl($_GET["uc"]);
    $clienteDomicilios = ControladorCliente::seleccionarClienteDomiciliosCtl($_GET["uc"]);
?>
<div class="title">
    <h2>Clientes</h2>
    <h3><?=$cliente["cliente"]?></h3>
</div>

<div class="C__F" id="form-card-client">
    <div class="Cards">
        <div><span name="Card-client-name"></span></div>
        <div>
            <div class="tabs">
                <a href="#tab-client-emails">Correos electrónicos</a>
                <a href="#tab-client-phones">Teléfonos</a>
                <a href="#tab-client-address">Domicilios</a>
            </div>
            <div name="tabs-content">
                <div id="tab-client-emails" class="ficha__info">
                    <div class="C__Btn">
                        <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-email">
                        <span class="tooltip">Agregar</span>
                    </div>
                    <?php if($clienteCorreos == null) : ?>
                        <div class="nodata"><span>Aún no hay registros</span></div>
                    <?php else : ?>
                        <div class="C__Btn">
                            <input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-email" disabled>
                            <span class="tooltip">Editar correo</span>
                        </div>
                        <div class="C__Btn">
                            <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-email" disabled>
                            <span class="tooltip">Borrar correo</span>
                        </div>
                        <table class="table" id="tbl-client-emails">
                            <caption>Correos electrónicos</caption>
                            <tr>
                                <th>
                                    <input type="checkbox" name="check-all-client-emails" id="check-all-client-emails">
                                    <span class="tooltip">Seleccionar todo</span>
                                </th>
                                <th>Correo electrónico</th>
                            </tr>
                            <?php foreach ($clienteCorreos as $key => $value) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="check-client-email" id="check-client-email<?=$value["iduser_correo"]?>" value="<?=$value["iduser_correo"]?>">
                                    <span class="tooltip">Seleccionar</span>
                                </td>
                                <td><?=$value["correo"]?></td>
                            </tr>
                            <?php endforeach ?>
                        </table>
                    <?php endif ?>
                </div>
                <div id="tab-client-phones" class="ficha__info">
                    <div class="C__Btn">
                        <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-phone">
                        <span class="tooltip">Agregar</span>
                    </div>
                    <?php if ($clienteTelefonos == null) : ?>
                        <div class="nodata"><span>Aún no hay registros</span></div>
                    <?php else : ?>
                        <div class="C__Btn">
                            <input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-phone" disabled>
                            <span class="tooltip">Editar correo</span>
                        </div>
                        <div class="C__Btn">
                            <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-phone" disabled>
                            <span class="tooltip">Borrar correo</span>
                        </div>
                        <table class="table" id="tbl-client-phones">
                            <caption>Teléfonos</caption>
                            <tr>
                                <th>
                                    <input type="checkbox" name="check-all-client-phones" id="check-all-client-phones">
                                    <span class="tooltip">Seleccionar todo</span>
                                </th>
                                <th>Número</th>
                                <th>Tipo</th>
                            </tr>
                            <?php foreach ($clienteTelefonos as $key => $value) : ?>
                                <?php switch ($value["tipo"]){
                                    case 1: $tipo = "Móvil"; break;
                                } ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="check-client-phone" id="check-client-phone<?=$cliente["iduser"]?>" value="<?=$cliente["iduser"]?>">
                                        <span class="tooltip">Seleccionar</span>
                                    </td>
                                    <td><?=$value["numero"]?></td>
                                    <td><?=$tipo?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    <?php endif ?>
                </div>
                <div id="tab-client-address" class="ficha__info">
                    <div class="C__Btn">
                        <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-address">
                        <span class="tooltip">Agregar</span>
                    </div>
                    <?php if($clienteDomicilios == null) : ?>
                        <div class="nodata"><span>Aún no hay registros</span></div>
                    <?php else : ?>
                        <div class="C__Btn">
                            <input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-email" disabled>
                            <span class="tooltip">Editar correo</span>
                        </div>
                        <div class="C__Btn">
                            <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-email" disabled>
                            <span class="tooltip">Borrar correo</span>
                        </div>
                        <table class="table" id="tbl-client-address">
                            <caption>Domicilios</caption>
                            <tr>
                                <th>
                                    <input type="checkbox" name="check-all-client-address" id="check-all-client-address">
                                    <span class="tooltip">Seleccionar todo</span>
                                </th>
                                <th>Domicilio</th>
                            </tr>
                            <?php foreach ($clienteDomicilios as $key => $value) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="check-client-address" id="check-client-address<?=$cliente["iduser"]?>" value="<?=$cliente["iduser"]?>">
                                    <span class="tooltip">Seleccionar</span>
                                </td>
                                <td><?=$value["calle"]?>, #<?=$value["num_casaex"]?>, <?=$value["colonia"]?></td>
                            </tr>
                            <?php endforeach ?>
                        </table>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="C__f oculto" id="form-add-client-email">
    <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-add-client-email" value="x">
        <h2 class="f__title">Nuevo correo electrónico</h2>
        <div class="line-top"></div>
        <div class="i__group">
            <input class="inputs" type="email" id="cliente-correo-new" name="cliente-correo-new" required>
            <label class="labels" for="cliente-correo-new">Correo Electrónico</label>
        </div>

        <input type="hidden" id="cliente-add-email-id" name="cliente-add-email-id" value="<?=$cliente["iduser"]?>" required>
        <input class="submit" type="submit" value="Crear">
        <?php Controlador::nuevoCorreoCtl(); ?>
    </form>
</div>

<div class="C__f oculto" id="form-edit-client-email">
    <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-edit-client-email" value="x">
        <h2 class="f__title">Actualizar correo electrónico</h2>
        <div class="line-top"></div>
        <div class="i__group">
            <input class="inputs" type="email" id="correo-cliente-edit" name="correo-cliente-edit" required>
            <label class="labels" for="correo-cliente-edit">Correo Electrónico</label>
        </div>

        <input type="hidden" id="email-client-edit-id" name="email-client-edit-id" required>
        <input class="submit" type="submit" value="Actualizar">
        <?php Controlador::actualizarCorreoCtl($cliente["iduser"]); ?>
    </form>
</div>

<div class="C__f oculto" id="form-add-client-phone">
    <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-add-client-phone" value="x">
        <h2 class="f__title">Nuevo número telefónico</h2>
        <div class="line-top"></div>
        <div class="i__group">
            <input class="inputs" type="number" id="cliente-telefono-new" name="cliente-telefono-new" maxlength="10" required>
            <label class="labels" for="cliente-telefono-new">Número</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="number" id="cliente-tipotelefono-new" name="cliente-tipotelefono-new" maxlength="1" required>
            <label class="labels" for="cliente-tipotelefono-new">Tipo</label>
        </div>
        
        <input type="hidden" id="cliente-add-phone-id" name="cliente-add-phone-id" value="<?=$cliente["iduser"]?>" required>
        <input class="submit" type="submit" value="Crear">
        <?php Controlador::nuevoTelefonoCtl(); ?>
    </form>
</div>

<div class="C__f oculto" id="form-edit-client-phone">
    <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-edit-client-phone" value="x">
        <h2 class="f__title">Nuevo número telefónico</h2>
        <div class="line-top"></div>
        <div class="i__group">
            <input class="inputs" type="number" id="cliente-telefono-edit" name="cliente-telefono-edit" maxlength="10" required>
            <label class="labels" for="cliente-telefono-edit">Número</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="number" id="cliente-tipotelefono-edit" name="cliente-tipotelefono-edit" maxlength="1" required>
            <label class="labels" for="cliente-tipotelefono-edit">Tipo</label>
        </div>
        
        <input type="hidden" id="cliente-edit-phone-id" name="cliente-edit-phone-id" value="<?=$cliente["iduser"]?>" required>
        <input class="submit" type="submit" value="Crear">
        <?php //Controlador::actualizarTelefonoCtl(); ?>
    </form>
</div>

<div class="C__f oculto" id="form-add-client-address">
    <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-add-client-address" value="x">
        <h2 class="f__title">Buscar mi domicilio</h2>
        <div class="line-top"></div>
        <div class="i__group">
            <label for="cliente-domicilio-ubicacion-new" class="labels">Buscar mi ubicación</label>
            <input class="inputs" type="text" id="cliente-domicilio-ubicacion-new" name="cliente-domicilio-ubicacion-new" placeholder="Colonia, Municipio" autofocus>
        </div>

        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-estado-new" name="cliente-domicilio-estado-new" required>
            <label class="labels" for="cliente-domicilio-estado-new">Estado</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-municipio-new" name="cliente-domicilio-municipio-new" required>
            <label class="labels" for="cliente-domicilio-municipio-new">Municipio</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-colonia-new" name="cliente-domicilio-colonia-new" required>
            <label class="labels" for="cliente-domicilio-colonia-new">Colonia</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-calle-new" name="cliente-domicilio-calle-new" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚ ]{5,50}" required>
            <label class="labels" for="cliente-domicilio-calle-new">Calle</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-numero-e-new" name="cliente-domicilio-numero-e-new" pattern="[0-9]{1,5}" required>
            <label class="labels" for="cliente-domicilio-numero-e-new">Número exterior</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-numero-i-new" name="cliente-domicilio-numero-i-new" pattern="[0-9]{0,5}">
            <label class="labels" for="cliente-domicilio-numero-i-new">Número interior / Departamento (opcional)</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-calle1-new" name="cliente-domicilio-calle1-new" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚ ]{0,25}">
            <label class="labels" for="cliente-domicilio-calle1-new">Calle 1</label>
        </div>
        
        <div class="i__group">
            <input class="inputs" type="text" id="cliente-domicilio-calle2-new" name="cliente-domicilio-calle2-new" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚ ]{0,25}">
            <label class="labels" for="cliente-domicilio-calle2-new">Calle 2</label>
        </div>
        
        <div class="i__group">
            <textarea type="text" id="cliente-domicilio-referencia-new" name="cliente-domicilio-referencia-new" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚ ]{10,50}" required></textarea>
            <label class="labels" for="cliente-domicilio-referencia-new">Descripción para encontrar su domicilio</label>
        </div>
        
        <input type="hidden" name="cliente-add-address-id" id="cliente-add-address-id" value="<?=$cliente["iduser"]?>" required>
        <input class="submit" type="submit" value="Agregar domicilio">
        <?php Controlador::nuevoDomicilioCtl(); ?>
    </form>
</div>
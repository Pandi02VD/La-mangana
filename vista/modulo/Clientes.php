<?php 
    $cargo = 0;
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        $cargo = $_SESSION["tipo-usuario"];
    }
    $clientes = Controlador::seleccionarClientesCtl();
?>
<h2>Clientes</h2>

<a class="link-button" href="index.php?pagina=Usuarios">Usuarios</a>
<a class="link-button active" href="index.php?pagina=Clientes">Clientes</a>

<?php if($cargo == 1 || $cargo == 2) { ?>
<div class="C__Table">
    <h3>Clientes</h3>

    <div class="Bar__Btns">
        <div class="C__Btn">
            <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client">
            <span class="tooltip">Agregar cliente</span>
        </div>
        <div class="C__Btn">
            <input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client" disabled>
            <span class="tooltip">Editar cliente</span>
        </div>
        <div class="C__Btn">
            <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client" disabled>
            <span class="tooltip">Borrar cliente</span>
        </div>
        <div class="C__Btn">
            <input type="image" src="img/identification_documents_32px.png" alt="imágen de acción" id="btn-card-client" disabled>
            <span class="tooltip">Ficha de información</span>
        </div>
        <div class="C__Btn__Last">
            <a href="#search-client"><image src="img/search_32px.png"></image></a>
            <input class="inputs" type="text" id="search-pet" name="search-pet" placeholder="Buscar cliente">
        </div>
        <!-- <div class="C__Btn__Last">
            <input type="button" class="button" id="exportExcel" onClick="Exportar('tbl-clientes')" value="Exportar a Excel">
        </div> -->
    </div>

    <table class="table" id="tbl-clientes">
        <tr>
            <th>
                <input type="checkbox" name="check-all-clients" id="check-all-clients">
                <span class="tooltip">Seleccionar todo</span>
            </th>
            <th>Nombre</th>
            <th>Fecha de registro</th>
            <th>Mascotas vinculadas</th>
        </tr>
            <?php 
                foreach($clientes as $key => $value) : 
                    $mascotasVinculadas = Controlador::contarMascotasClienteCtl($value["iduser"]);
            ?>
            
        <tr>
            <td>
                <input type="checkbox" name="check-client" id="check-client<?=$value["iduser"]?>" value="<?=$value["iduser"]?>">
                <span class="tooltip">Seleccionar</span>
            </td>
            <td id="<?=$value["iduser"]?>" name="clients-table"><?=$value["nombre"]?></td>
            <td id="<?=$value["iduser"]?>" name="clients-table"><?=$value["fecha"]?></td>
            <td id="<?=$value["iduser"]?>" name="clients-table"><a href="index.php?pagina=MascotasCliente&vru=<?=$value["iduser"]?>"><?=$mascotasVinculadas["num_mascotas"]?></a></td>
        </tr>
            <?php endforeach ?>
    </table>

    <div class="C__f oculto" id="form-add-client">
        <form method="post" class="f">
            <input class="f__close" type="button" id="btn-close-form-add-client" value="X">
            <h2 class="f__title">Crear Cliente</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <input class="inputs" type="text" id="cliente-new" name="cliente-new" required>
                <label class="labels" for="cliente-new">Nombre del cliente</label>
            </div>

            <div class="i__group">
                <label class="label-checkbox" for="vinculo-animal">Registrar vínculo animal</label>
                <input type="checkbox" name="vinculo-animal" id="vinculo-animal">
                <div class="D-info">
                    <p class="info"><i>i</i> Active la casilla si desea registrar los datos de una mascota a nombre de ese cliente.</p>
                </div>
            </div>
            
            <input class="submit" type="submit" value="Crear">
            <?php 
                $crearCliente = Controlador::crearClienteCtl();
            ?>
        </form>
    </div>

    <div class="C__f oculto" id="form-edit-client">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-edit-client" value="X">
            <h2 class="f__title">Editar Cliente</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <input class="inputs" type="text" name="cliente-edit" id="cliente-edit" required>
                <label class="labels" for="cliente-edit">Nombre del cliente</label>
            </div>

            <input class="submit" type="submit" value="Actualizar">
            <input type="hidden" name="clienteId-edit" id="clienteId-edit">
            <?php 
                $actualizarCliente = Controlador::actualizarClienteCtl();
            ?>
        </form>
    </div>
    
    <div class="C__f oculto" id="form-delete-client">
        <form method="post" class="f">
            <input class="f__close" type="button" id="btn-close-form-delete-client" value="X">
            <h2 class="f__title">Confirmación</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
            </div>

            <input class="submit" type="button" id="btn-C-delete-client" value="Confirmar">
            <?php 
                // $eliminarCliente = Controlador::eliminarClienteCtl();
            ?>
        </form>
    </div>

    <div class="C__f oculto" id="form-card-client">
        <div class="Cards">
            <input class="f__close" type="button" id="btn-close-form-card-client" value="X">
            <div><span name="Card-client-name"></span></div>
            <div>
                <div class="tabs">
                    <a href="#tab-client-email">Correos electrónicos</a>
                    <a href="#tab-client-phone">Teléfonos</a>
                    <a href="#tab-client-address">Domicilios</a>
                </div>
                <div name="tabs-content">
                    <div id="tab-client-email" class="ficha__info">
                        <div class="C__Btn">
                            <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-email">
                            <span class="tooltip">Agregar</span>
                        </div>
                        <table class="table" id="tbl-client-emails">
                            <caption>Correos electrónicos</caption>
                            <tr>
                                <th>Correo electrónico</th>
                                <th>Acción</th>
                            </tr>
                            <!-- <tr>
                                <td name="client-email-address">Error</td>
                                <td>
                                    <div class="C__Btn">
                                        <input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-email" disabled>
                                        <span class="tooltip">Editar</span>
                                    </div>
                                    <div class="C__Btn">
                                        <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-email" disabled>
                                        <span class="tooltip">Eliminar</span>
                                    </div>
                                </td>
                            </tr> -->
                        </table>
                    </div>
                    <div id="tab-client-phone" class="ficha__info">
                    <div class="C__Btn">
                            <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-phone" disabled>
                            <span class="tooltip">Agregar</span>
                        </div>
                        <table class="table">
                            <caption>Teléfonos</caption>
                            <tr>
                                <th>Número</th>
                                <th>Tipo</th>
                                <th>Acción</th>
                            </tr>
                            <!-- <tr>
                                <td name="client-phone-number">Error</td>
                                <td name="client-phone-type">Error</td>
                                <td>
                                    <div class="C__Btn">
                                        <input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-phone" disabled>
                                        <span class="tooltip">Editar</span>
                                    </div>
                                    <div class="C__Btn">
                                        <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-phone" disabled>
                                        <span class="tooltip">Eliminar</span>
                                    </div>
                                </td>
                            </tr> -->
                        </table>
                    </div>
                    <div id="tab-client-address" class="ficha__info">
                        <table class="table">
                            <caption>Domicilios</caption>
                            <tr><td>Inicio: </td><td>12/02/2021 12:09 p. m.</td></tr>
                            <tr><td>Fin: </td><td>12/02/2021 12:22 p. m.</td></tr>
                            <tr><td>Observaciones: </td><td>Bla bla bla</td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
    </div>

    <div class="C__f oculto" id="form-add-client-email">
        <form method="post" class="f">
            <input class="f__close" type="button" id="btn-close-form-add-client-email" value="X">
            <h2 class="f__title">Nuevo correo electrónico</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <input class="inputs" type="email" id="cliente-correo-new" name="cliente-correo-new" required>
                <label class="labels" for="cliente-correo-new">Correo Electrónico</label>
            </div>

            <div class="i__group">
                <input type="hidden" id="cliente-add-phone-id" name="cliente-add-phone-id" required>
            </div>
            
            <input class="submit" type="submit" value="Crear">
            <?php 
                $nuevoCorreo = Controlador::nuevoCorreoCtl();
            ?>
        </form>
    </div>
</div>
<?php } ?>
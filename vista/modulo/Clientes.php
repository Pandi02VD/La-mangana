<?php 
    $cargo = 0;
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        $cargo = $_SESSION["tipo-usuario"];
    }
    $clientes = ControladorCliente::seleccionarClientesCtl();
?>

<div class="title">
    <h2>Clientes</h2>
    <a class="link-button" href="index.php?pagina=Usuarios">Usuarios</a>
    <a class="link-button active" href="index.php?pagina=Clientes">Clientes</a>
</div>

<?php if($cargo == 1 || $cargo == 2) { ?>
<div class="C__Table">

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
                    $mascotasVinculadas = ControladorCliente::contarMascotasClienteCtl($value["iduser"]);
            ?>
            
        <tr>
            <td>
                <input type="checkbox" name="check-client" id="check-client<?=$value["iduser"]?>" value="<?=$value["iduser"]?>">
                <span class="tooltip">Seleccionar</span>
            </td>
            <td id="<?=$value["iduser"]?>" name="clients-table"><?=$value["nombre"]?></td>
            <td id="<?=$value["iduser"]?>" name="clients-table"><?=$value["fecha"]?></td>
            <td id="<?=$value["iduser"]?>" name="clients-table"><a href="index.php?pagina=MascotasCliente&um=<?=$value["iduser"]?>"><?=$mascotasVinculadas["num_mascotas"]?></a></td>
        </tr>
            <?php endforeach ?>
    </table>

    <div class="C__f oculto" id="form-add-client">
        <form method="post" class="f">
            <input class="f__close" type="button" id="btn-close-form-add-client" value="x">
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
            <?php $crearCliente = ControladorCliente::crearClienteCtl(); ?>
        </form>
    </div>

    <div class="C__f oculto" id="form-edit-client">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-edit-client" value="x">
            <h2 class="f__title">Editar Cliente</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <input class="inputs" type="text" name="cliente-edit" id="cliente-edit" required>
                <label class="labels" for="cliente-edit">Nombre del cliente</label>
            </div>

            <input type="hidden" name="clienteId-edit" id="clienteId-edit">
            <input class="submit" type="submit" value="Actualizar">
            <?php $actualizarCliente = ControladorCliente::actualizarClienteCtl(); ?>
        </form>
    </div>
    
    <div class="C__f oculto" id="form-delete-client">
        <form method="post" class="f">
            <input class="f__close" type="button" id="btn-close-form-delete-client" value="x">
            <h2 class="f__title">Confirmación</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
            </div>
            <div class="D-info">
                <p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
            </div>
            <input class="submit" type="button" id="btn-C-delete-client" value="Confirmar">
        </form>
    </div>
</div>
<?php } ?>
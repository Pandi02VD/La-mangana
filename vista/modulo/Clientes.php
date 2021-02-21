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
    <!-- <div> -->
        <div class="C__Btn">
            <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client">
            <span class="tooltip">Agregar cliente</span>
        </div>
        <div class="C__Btn">
            <input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client" disabled>
            <span class="tooltip">Editar cliente</span>
        </div>
        <div class="C__Btn">
            <input type="image" src="img/waste_32px.png" alt="imágen de acción" id="btn-delete-client" disabled>
            <span class="tooltip">Borrar cliente</span>
        </div>
    <!-- </div> -->
    <table id="table">
        <tr>
            <th><input type="checkbox" name="check-all-clients" id="check-all-clients"></th>
            <th>Nombre</th>
            <th>Fecha de registro</th>
            <th>Mascotas vinculadas</th>
            <th>Detalles</th>
        </tr>
            <?php 
                foreach($clientes as $key => $value) : 
                    $mascotasVinculadas = Controlador::contarMascotasClienteCtl($value["iduser"]);
            ?>
            
        <tr>
            <td><input type="checkbox" name="check-client" id="check-client<?=$value["iduser"]?>" value="<?=$value["iduser"]?>"></td>
            <td><?=$value["nombre"]?></td>
            <td><?=$value["fecha"]?></td>
            <td><a href="index.php?pagina=MascotasCliente&vru=<?=$value["iduser"]?>"><?=$mascotasVinculadas["num_mascotas"]?></a></td>
            <td><a href="index.php?pagina=MascotasCliente&vru=<?=$value["iduser"]?>">Ver más</a></td>
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
</div>
<?php } ?>
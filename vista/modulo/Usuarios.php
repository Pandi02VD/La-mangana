<?php 
    $cargo = 0;
    if(isset($_SESSION["tipo-usuario"])){
        $cargo = $_SESSION["tipo-usuario"];
    }
    $usuarios = ControladorUsuario::seleccionarUsuariosCtl();
?>
<div class="title">
    <h2>Usuarios</h2>
    <a class="link-button active" href="index.php?pagina=Usuarios">Usuarios</a>
    <a class="link-button" href="index.php?pagina=Clientes">Clientes</a>
</div>

<?php if($cargo == 1) :?>
<div class="C__Table">    
    <div>
        <div class="C__Btn">
            <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-user">
            <span class="tooltip">Agregar usuario</span>
        </div>
        <div class="C__Btn">
            <input type="image" src="img/edit_32px.png" alt="imágen de acción"  id="btn-edit-user" disabled>
            <span class="tooltip">Editar usuario</span>
        </div>
        <div class="C__Btn">
            <input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-user" disabled>
            <span class="tooltip">Eliminar usuario</span>
        </div>
    </div>

    <div class="D-info">
        <p class="info">Haga clic en un usuario para ver más información 
            <button class="tag__close" name="btn-close-info">x</button>
        </p>
    </div>

    <table class="table" id="tbl-usuarios">
        <tr>
            <th>
                <input type="checkbox" name="check-all-users" id="check-all-users">
                <span class="tooltip">Seleccionar todo</span>
            </th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Fecha de registro</th>
            <th>Estado</th>
        </tr>
            <?php 
                // $miArreglo = array('material' => 'madera', 
                //                          'costo' => '$300.00',
                //                          'diseño' => 'moderno',
                //                          ); 
            ?>
            <?php 
                foreach($usuarios as $key => $value) :
                    if($value["tipo"] == 1) {
                        $tipo = "Administrador";
                    }elseif ($value["tipo"] == 2) {
                        $tipo = "Asistente";
                    }elseif ($value["tipo"] == 3) {
                        $tipo = "Médico";
                    }
                    $value["status"] == 1 ? $status = "En línea" : $status = "Desconectado" ; 
            ?>
            
        <tr>
            <?php if($value["tipo"] == 1) { ?>
                <td><img src="img/crown_20px.png" alt="Ícono de administrador"></img></td>
            <?php }else{ ?>
                <td>
                    <input type="checkbox" name="check-user" id="check-user<?=$value["iduser"]?>" value="<?=$value["iduser"]?>">
                    <span class="tooltip">Seleccionar</span>
                </td>
            <?php } ?>
            <td id="<?=$value["iduser"]?>" name="users-table"><?=$value["nombre"]?></td>
            <td id="<?=$value["iduser"]?>" name="users-table"><?=$tipo?></td>
            <td id="<?=$value["iduser"]?>" name="users-table"><?php echo $value["fecha"]?></td>
            <td id="<?=$value["iduser"]?>" name="users-table">
                <span name="user-status" id="<?=$value["iduser"]?>"><?=$status?></span>
                <input type="hidden" name="<?=$value["status"]?>">
            </td>
    
        </tr>
            <?php endforeach ?>
    </table>

    <div class="C__f oculto" id="form-add-user">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-add-user" value="x">
        <h2 class="f__title">Crear Cuenta</h2>
        <div class="line-top"></div>
        <div class="i__group">
            <label class="label-checkbox" for="tipo-usuario-new">Tipo de usuario</label>
            <select name="tipo-usuario-new" id="tipo-usuario-new" required>
                <option value="">Seleccione el tipo de usuario</option>
                <option value="2">Asistente</option>
                <option value="3">Médico</option>
            </select>
        </div>
            
        <div class="i__group">
            <label class="labels" for="nombre-new">Nombre</label>
            <input class="inputs" type="text" id="nombre-new" name="nombre-new" required>
        </div>

        <div class="i__group">
            <label class="labels" for="usuario-new">Usuario</label>
            <input class="inputs" type="text" id="usuario-new" name="usuario-new" required>
        </div>
            
        <div class="i__group">
            <label class="labels" for="contrasena-new">Contraseña</label>
            <input class="inputs" type="password" id="contrasena-new" name="contrasena-new" required>
        </div>
        
        <input class="submit" type="submit" value="Crear">
        <?php 
            $crearUsuario = ControladorUsuario::crearCuentaCtl();
        ?>
        </form>

    </div>

    <div class="C__f oculto" id="form-edit-user">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-edit-user" value="x">
            <h2 class="f__title">Editar Usuario</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <!-- <label class="labels" for="tipo-usuario-edit">Tipo de usuario</label> -->
                <select name="tipo-usuario-edit" id="tipo-usuario-edit" required>
                    <option value="">Seleccione el tipo de usuario</option>
                    <option value="2">Asistente</option>
                    <option value="3">Médico</option>
                </select>
            </div>

            <div class="i__group">
                <label class="labels" for="nombre-edit">Nombre</label>
                <input class="inputs" type="text" id="nombre-edit" name="nombre-edit" required>
            </div>
            
            <input class="submit" type="submit" value="Actualizar">
            <input type="hidden" name="usuarioId-edit" id="usuarioId-edit">
            <?php 
                $actualizaUsuario = ControladorUsuario::actualizarUsuarioCtl();
            ?>
        </form>
    </div>

    <div class="C__f oculto" id="form-delete-user">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-delete-user" value="x">
            <h2 class="f__title">Confirmación</h2>
            <div class="line-top"></div>
            <span class="label-checkbox">¿Desea eliminar los registros?</span>
            <div class="D-info">
                <p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
            </div>
            <span class="label-checkbox"></span>
            <input class="submit" type="button" id="btn-C-delete-user" value="Confirmar">
        </form>
    </div>
</div>
<?php endif ?>
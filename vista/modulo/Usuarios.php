<?php 
    $cargo = 0;
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        $cargo = $_SESSION["tipo-usuario"];
    }
    $usuarios = Controlador::seleccionarUsuariosCtl();
?>
<h2>Usuarios</h2>

<a class="link-button active" href="index.php?pagina=Usuarios">Usuarios</a>
<a class="link-button" href="index.php?pagina=Clientes">Clientes</a>

<?php if($cargo == 1) :?>
<div class="C__Table">
    <h3>Usuarios</h3>
    <!-- <div> -->
    <div class="C__Btn">
        <input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-user">
        <span class="tooltip">Agregar usuario</span>
    </div>
    <div class="C__Btn">
        <input type="image" src="img/edit_32px.png" alt="imágen de acción"  id="btn-edit-user" disabled>
        <span class="tooltip">Editar usuario</span>
    </div>
    <div class="C__Btn">
        <input type="image" src="img/waste_32px.png" alt="imágen de acción" id="btn-delete-user" disabled>
        <span class="tooltip">Eliminar usuario</span>
    </div>
    <!-- </div> -->
    <table id="table">
        <tr>
            <th><input type="checkbox" name="check-all-users" id="check-all-users"></th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Fecha de registro</th>
            <th>Estado</th>
            <th>Detalles</th>
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
                <td><input type="checkbox" name="check-user" id="check-user<?=$value["iduser"]?>" value="<?=$value["iduser"]?>"></td>
            <?php } ?>
            <td><?=$value["nombre"]?></td>
            <td><?=$tipo?></td>
            <td><?php echo $value["fecha"]?></td>
            <td><?=$status?></td>
            <td>Ver más</td>
    
        </tr>
            <?php endforeach ?>
    </table>
    <div class="D-info">
        <p class="info">Haga clic en un usuario para ver más información 
            <button class="f__close unset" name="btn-close-info">x</button>
        </p>
    </div>
    
    <div class="D-info">
        <p class="info" style="background-color: cadetblue">Consulte la guía de usuario integrada en la sección "Ayuda" para saber más sobre el funcionamiento del sistema
            <button class="f__close unset" name="btn-close-info">x</button>
        </p>
    </div>

    <div class="C__f oculto" id="form-add-user">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-add-user" value="X">
        <h2 class="f__title">Crear Cuenta</h2>
        <div class="line-top"></div>
        <div class="i__group">
            <label class="label-checkbox" for="tipo-usuario-new">Tipo de usuario</label>
            <select name="tipo-usuario-new" id="tipo-usuario-new">
                <option value="">Seleccione el tipo de usuario</option>
                <option value="2">Asistente</option>
                <option value="3">Médico</option>
            </select>
        </div>
            
        <div class="i__group">
            <label class="labels" for="nombre-new">Nombre</label>
            <input class="inputs" type="text" id="nombre-new" name="nombre-new">
        </div>

        <div class="i__group">
            <label class="labels" for="usuario-new">Usuario</label>
            <input class="inputs" type="text" id="usuario-new" name="usuario-new">
        </div>
            
        <div class="i__group">
            <label class="labels" for="contrasena-new">Contraseña</label>
            <input class="inputs" type="password" id="contrasena-new" name="contrasena-new">
        </div>
        
        <input class="submit" type="submit" value="Crear">
        <div class="line-bottom"></div>
        <a href="index.php?pagina=IniciarSesion">Ya tengo una cuenta</a>
        <?php 
            $crearUsuario = Controlador::crearCuentaCtl();
        ?>
        </form>

    </div>

    <div class="C__f oculto" id="form-edit-user">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-edit-user" value="X">
            <h2 class="f__title">Editar Usuario</h2>
            <div class="line-top"></div>
            <div class="i__group">
                <!-- <label class="labels" for="tipo-usuario-edit">Tipo de usuario</label> -->
                <select name="tipo-usuario-edit" id="tipo-usuario-edit">
                    <option value="">Seleccione el tipo de usuario</option>
                    <option value="2">Asistente</option>
                    <option value="3">Médico</option>
                </select>
            </div>

            <div class="i__group">
                <label class="labels" for="nombre-edit">Nombre</label>
                <input class="inputs" type="text" id="nombre-edit" name="nombre-edit">
            </div>
            
            <input class="submit" type="submit" value="Actualizar">
            <input type="hidden" name="usuarioId-edit" id="usuarioId-edit">
            <?php 
                $actualizaUsuario = Controlador::actualizarUsuarioCtl();
            ?>
        </form>
    </div>

    <div class="C__f oculto" id="form-delete-user">
        <form method="post" class="f">
        <input class="f__close" type="button" id="btn-close-form-delete-user" value="X">
            <h2 class="f__title">Confirmación</h2>
            <div class="line-top"></div>
            <span class="label-checkbox">¿Desea eliminar el registro?</span>
            
            <input class="submit" type="submit" id="btn-C-delete-user" value="Confirmar">
            <?php 
                // $actualizaUsuario = Controlador::actualizarUsuarioCtl();
            ?>
        </form>
    </div>
</div>
<?php endif ?>
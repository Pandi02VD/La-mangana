<?php 
    $cargo = 0;
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        $cargo = $_SESSION["tipo-usuario"];
    }
    $usuarios = Controlador::seleccionarUsuariosCtl();
    $clientes = Controlador::seleccionarClientesCtl();
?>
<h2>Clientes & Usuarios</h2>

<a href="index.php?pagina=CrearCuenta">Nuevo Usuario</a>
<a href="index.php?pagina=CrearCliente">Nuevo Cliente</a>

<?php if($cargo == 1) :?>
<div style="border: 1px solid red">
    <h3>Usuarios</h3>
    <table>
        <tr>
            <th><input type="checkbox" name="check-all-users" id="check-all-users"></th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Fecha</th>
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
            <?php 
            // if ($value["tipo"] == 1) {
            //     $tiipo = "Personal";
            // } else if($value["tipo"] == 0) {
            //     $tiipo = "Administrador";
            // }else{
            //     $tiipo = "Otro";
            // }
            ?>
            
        <tr>
            <td style="background: pink"><input type="checkbox" name="check-user" id="check-user<?=$value["iduser"]?>" value="<?=$value["iduser"]?>"></td>
            <td style="background: pink"><?=$value["nombre"]?></td>
            <td style="background: pink"><?=$tipo?></td>
            <td style="background: pink"><?php echo $value["fecha"]?></td>
            <td style="background: pink"><?=$status?></td>
    
        </tr>
            <?php endforeach ?>
    </table>
<div>
    <!-- <form method="post"> -->
        <!-- <input type="submit" id="btn-edit-user" value="Editar" disabled> -->
        <input type="button" id="btn-edit-user" value="Editar" disabled>
    <!-- </form> -->
    <!-- <form method="post"> -->
        <!-- <input type="submit" id="btn-delete-user" value="Borrar" disabled> -->
        <input type="button" id="btn-delete-user" value="Borrar" disabled>
    <!-- </form> -->
</div>
<div class="f__e__usuario oculto" id="form-edit-user">
    <button id="btn-close-form-edit-user">X</button>
    <form method="post" class="f">
        <h4>Editar Usuario</h4>
        <div>
        <label for="tipo-usuario">Tipo de usuario</label>
        <select name="tipo-usuario" id="tipo-usuario">
            <option value="">Seleccione tipo de usuario</option>
            <option value="2">Asistente</option>
            <option value="3">Médico</option>
        </select>
        </div>
        
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre">
        </div>
<!-- 
        <div>
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario">
        </div>
        
        <div>
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena">
        </div>
         -->
        <div>
            <input type="submit" value="Actualizar">
            <input type="hidden" name="usuarioId" id="usuarioId">
        </div>
            <?php 
                $actualizaUsuario = Controlador::actualizarUsuarioCtl();
            ?>
    </form>
</div>
</div>
<?php endif ?>

<?php if($cargo == 1 || $cargo == 2) { ?>
<div style="border: 1px solid blue">
    <h3>Clientes</h3>
    <table>
        <tr>
            <th><input type="checkbox" name="check-all-clients" id="check-all-clients"></th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Mascotas vinculadas</th>
        </tr>
            <?php 
                foreach($clientes as $key => $value) : 
                    $mascotasVinculadas = Controlador::contarMascotasClienteCtl($value["iduser"]);
            ?>
            
        <tr>
            <td style="background: skyblue; padding:"><input type="checkbox" name="check-client" id="check-client<?=$value["iduser"]?>" value="<?=$value["iduser"]?>"></td>
            <td style="background: skyblue; padding:"><?=$value["nombre"]?></td>
            <td style="background: skyblue; padding:"><?=$value["fecha"]?></td>
            <td style="background: skyblue; padding:"><a href="index.php?pagina=MascotasUsuario&vru=<?=$value["iduser"]?>"><?=$mascotasVinculadas["num_mascotas"]?></a></td>
        </tr>
            <?php endforeach ?>
    </table>
<div>
    <!-- <form method="post"> -->
        <!-- <input type="submit" id="btn-edit-client" value="Editar" disabled> -->
        <input type="button" id="btn-edit-client" value="Editar" disabled>
    <!-- </form> -->
    <!-- <form method="post"> -->
        <!-- <input type="submit" id="btn-delete-client" value="Borrar" disabled> -->
        <input type="button" id="btn-delete-client" value="Borrar" disabled>
    <!-- </form> -->
</div>
<div class="f__e__cliente oculto" id="form-edit-client">
    <button id="btn-close-form-edit-client">X</button>
    <form method="post" class="f">
        <h4>Editar Cliente</h4>
        <label for="cliente">Nombre</label>
        <input type="text" name="cliente" id="cliente">
        <div>
            <input type="submit" value="Actualizar">
            <input type="hidden" name="clienteId" id="clienteId">
        </div>
            <?php 
                $actualizarCliente = Controlador::actualizarClienteCtl();
            ?>
    </form>
</div>
</div>
<?php } ?>
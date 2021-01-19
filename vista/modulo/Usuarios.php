<?php 
    $usuarios = Controlador::seleccionarUsuariosCtl();
    $clientes = Controlador::seleccionarClientesCtl();
?>
<h1>Clientes & Usuarios</h1>

<a href="index.php?pagina=CrearCuenta">Nuevo Usuario</a>
<a href="index.php?pagina=CrearCliente">Nuevo Cliente</a>

<?php if(isset($_SESSION["ingresado"])){ ?>
<div style="border: 1px solid red">
    <h4>Contenido privado (Usuarios)</h4>
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
</div>
<?php } ?>

<div style="border: 1px solid blue">
    <h4>Contenido público (Clientes)</h4>
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
</div>
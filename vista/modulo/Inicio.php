<?php 
    $usuarios = Controlador::seleccionarUsuariosCtl();
?>
<h1>Inicio</h1>

<?php if(isset($_SESSION["ingresado"])){ ?>
<div style="border: 1px solid red">
    <h4>Contenido privado</h4>
    <table>
        <tr>
            <th>Nombre</th>
            <!-- <th>Usuario</th>
            <th>Contraseña</th> -->
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
                foreach($usuarios as $key => $value) {
                    $value["tipo"] == 1 ? $tipo = "Administrador" : $tipo = "Personal" ;
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
            <td style="background: pink"><?=$value["nombre"]?></td>
            <td style="background: pink"><?=$tipo?></td>
            <td style="background: pink"><?php echo $value["fecha"]?></td>
            <td style="background: pink"><?=$status?></td>
    
        </tr>
            <?php } ?>
    </table>
</div>
<?php } ?>

<div style="border: 1px solid blue">
<h4>Contenido público</h4>
</div>
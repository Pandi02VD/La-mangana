<?php 
    if (!isset($_GET["vru"])) {
        echo '<script>window.location = "index.php?pagina=Error";</script>';
    }
    $clienteId = $_GET["vru"];
    $mascotasCliente = Controlador::mascotasClienteCtl($clienteId);
    $cliente = Controlador::seleccionarClienteCtl($clienteId);
?>
<h1>Mascotas de <?= $cliente["nombre"] == null ? "X" : $cliente["nombre"] ;?></h1>

<div style="border: 1px solid red">
    <h4>Mascotas</h4>
    <?php if ($mascotasCliente == null) { ?>
            <div><span>Aún no hay registros</span></div>
    <?php }else{ ?>
    <table>
        <tr>
            <th><input type="checkbox" name="check-all-pets" id="check-all-pets"></th>
            <th>Nombre</th>
            <th>Fecha</th>
        </tr>
            <?php foreach($mascotasCliente as $key => $value) : ?>
            
        <tr>
            <td style="background: pink; padding:"><input type="checkbox" name="check-pet" id="check-pet<?=$value["idmascota"]?>" value="<?=$value["idmascota"]?>"></td>
            <td style="background: pink; padding:"><?=$value["nombre"]?></td>
            <td style="background: pink; padding:"><?=$value["fecha"]?></td>
        </tr>
            <?php endforeach ?>
    </table>
    <?php } ?>
</div>
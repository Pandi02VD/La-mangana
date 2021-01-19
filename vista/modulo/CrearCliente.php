<h1>Crear Cliente</h1>

<form method="post">    
    <div>
        <label for="cliente">Nombre del cliente</label>
        <input type="text" id="cliente" name="cliente">
    </div>

    <div>
        <label for="vinculo-animal">Registrar vínculo animal</label>
        <input type="checkbox" name="vinculo-animal" id="vinculo-animal">
        <p>Información: Active la casilla si desea registrar los datos de una mascota a nombre de ese cliente</p>
    </div>
    
    <div>
        <input type="submit" value="Crear">
    </div>
        <?php 
            $crearCliente = Controlador::crearClienteCtl();
        ?>
</form>

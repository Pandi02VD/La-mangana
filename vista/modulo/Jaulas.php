<?php 
	$cargo = $_SESSION["tipo-usuario"];
	$jaulas = ControladorMascota::seleccionarJaulasCtl();
?>

<div class="title">
	<h2>Jaulas</h2>
	<a class="link-button" href="index.php?pagina=Mascotas">Mascotas</a>
	<a class="link-button" href="index.php?pagina=Razas">Razas</a>
	<a class="link-button active" href="index.php?pagina=Jaulas">Jaulas</a>
</div>

<?php if($cargo == 1 || $cargo == 2) { ?>
<div class="C__Table">
	<?php if ($jaulas == null) { ?>
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
			<span class="tooltip">Agregar jaula</span>
		</div>
		<div class="nodata"><span>Aún no hay registros</span></div>
	<?php }else{ ?>
	<div class="Bar__Btns">
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client">
			<span class="tooltip">Agregar Jaula</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client" disabled>
			<span class="tooltip">Editar Jaula</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client" disabled>
			<span class="tooltip">Borrar Jaula</span>
		</div>
		<div class="C__Btn__Last">
			<a href="#search-client"><image src="img/search_32px.png"></image></a>
			<input class="inputs" type="text" id="search-pet" name="search-pet" placeholder="Buscar cliente">
		</div>
	</div>

	<div class="D-info">
		<p class="info">Más información
			<button class="tag__close" name="btn-close-info">x</button>
		</p>
	</div>

	<table class="table" id="tbl-clientes">
		<tr>
			<th>
				<input type="checkbox" name="check-all-clients" id="check-all-clients">
				<span class="tooltip">Seleccionar todo</span>
			</th>
			<th>Raza</th>
		</tr>
			<?php foreach($jaulas as $key => $value) : ?>
		<tr>
			<td>
				<input type="checkbox" name="check-client" id="check-client<?=$value["idjaula"]?>" value="<?=$value["idjaula"]?>">
				<span class="tooltip">Seleccionar</span>
			</td>
			<td name="clients-table"><?=$value["jaula"]?></td>
		</tr>
			<?php endforeach ?>
	</table>

	<div class="C__f oculto" id="form-edit-client">
		<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-client" value="x">
			<h2 class="f__title">Editar Cliente</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<input class="inputs" type="text" name="cliente-edit" id="cliente-edit" required>
				<label class="labels" for="cliente-edit">Nombre del cliente</label>
			</div>

			<input type="hidden" name="clienteId-edit" id="clienteId-edit" required>
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
	<?php } ?>
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
			<?php ControladorCliente::crearClienteCtl(); ?>
		</form>
	</div>
</div>
<?php } ?>
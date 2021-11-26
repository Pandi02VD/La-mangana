<?php 
	$cargo = $_SESSION["tipo-usuario"];
	$jaulas = ControladorMascota::seleccionarJaulasCtl();
	$jaulaStatus = array('1' => 'Disponible', '2' => 'Ocupado');
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
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-jaula">
			<span class="tooltip">Agregar jaula</span>
		</div>
		<div class="nodata"><span>Aún no hay registros</span></div>
	<?php }else{ ?>
	<div class="Bar__Btns">
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-jaula">
			<span class="tooltip">Agregar Jaula</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-jaula" disabled>
			<span class="tooltip">Editar Jaula</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-jaula" disabled>
			<span class="tooltip">Borrar Jaula</span>
		</div>
		<div class="C__Btn__Last">
			<input class="inputs box" type="text" id="search-jaula" name="search-jaula" placeholder="Buscar Jaula">
			<span class="iconSearch"><image src="img/search_20px.png"></image></span>
		</div>
	</div>

	<div class="D-info">
		<p class="info">Más información
			<button class="tag__close" name="btn-close-info">x</button>
		</p>
	</div>

	<table class="table" id="tbl-jaulas">
		<tr>
			<th>
				<input type="checkbox" name="check-all-jaulas" id="check-all-jaulas">
				<span class="tooltip">Seleccionar todo</span>
			</th>
			<th>Jaula</th>
			<th>Estado</th>
		</tr>
			<?php foreach($jaulas as $key => $value) : ?>
		<tr>
			<td>
				<input type="checkbox" name="check-jaula" id="check-jaula<?=$value["idjaula"]?>" value="<?=$value["idjaula"]?>">
				<span class="tooltip">Seleccionar</span>
			</td>
			<td name="jaulas-table"><?=$value["jaula"]?></td>
			<td name="jaulas-table"><?=$jaulaStatus[$value["status"]]?></td>
		</tr>
			<?php endforeach ?>
	</table>

	<div class="C__f oculto" id="form-edit-jaula">
		<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-jaula" value="x">
			<h2 class="f__title">Editar Jaula</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<input class="inputs" type="text" id="jaula-num-edit" name="jaula-num-edit" list="items" required>
				<datalist id="items">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</datalist>
				<label class="labels" for="jaula-num-edit">Número de jaula</label>
			</div>

			<input type="hidden" name="jaulaId-edit" id="jaulaId-edit" required>
			<input class="submit" type="submit" value="Actualizar">
			<?php ControladorMascota::actualizarJaulaCtl(); ?>
		</form>
	</div>
	
	<div class="C__f oculto" id="form-delete-jaula">
		<form method="post" class="f">
			<input class="f__close" type="button" id="btn-close-form-delete-jaula" value="x">
			<h2 class="f__title">Confirmación</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
			</div>
			<div class="D-info">
				<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
			</div>
			<input class="submit" type="button" id="btn-C-delete-jaula" value="Confirmar">
		</form>
	</div>
	<?php } ?>
	<div class="C__f oculto" id="form-add-jaula">
		<form method="post" class="f">
			<input class="f__close" type="button" id="btn-close-form-add-jaula" value="x">
			<h2 class="f__title">Agregar jaula</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<input class="inputs" type="text" id="jaula-num-new" name="jaula-num-new" list="items" required>
				<datalist id="items">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</datalist>
				<label class="labels" for="jaula-num-new">Número de jaula</label>
			</div>
			
			<input class="submit" type="submit" value="Agregar">
			<?php ControladorMascota::nuevaJaulaCtl(); ?>
		</form>
	</div>
</div>
<?php } ?>
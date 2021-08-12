<?php 
	$cargo = $_SESSION["tipo-usuario"];
	$razas = ControladorMascota::seleccionarRazasCtl();
	$especies = ControladorMascota::seleccionarEspeciesCtl();
?>

<div class="title">
	<h2>Jaulas</h2>
	<a class="link-button" href="index.php?pagina=Mascotas">Mascotas</a>
	<a class="link-button active" href="index.php?pagina=Razas">Razas</a>
	<a class="link-button" href="index.php?pagina=Jaulas">Jaulas</a>
</div>

<?php if($cargo == 1 || $cargo == 2) { ?>
<div class="C__Table">
	<?php if ($razas == null) { ?>
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-raza">
			<span class="tooltip">Agregar Raza</span>
		</div>
		<div class="nodata"><span>Aún no hay registros</span></div>
	<?php } else { ?>
	<div class="Bar__Btns">
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-raza">
			<span class="tooltip">Agregar Raza</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-raza" disabled>
			<span class="tooltip">Editar Raza</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-raza" disabled>
			<span class="tooltip">Borrar Raza</span>
		</div>
		<div class="C__Btn__Last">
			<input class="inputs" type="search" id="search-raza" name="search-raza" placeholder="Buscar Raza">
			<span class="iconSearch"><image src="img/search_32px.png"></image></span>
		</div>
	</div>

	<div class="D-info">
		<p class="info">Más información
			<button class="tag__close" name="btn-close-info">x</button>
		</p>
	</div>

	<table class="table" id="tbl-razas">
		<tr>
			<th>
				<input type="checkbox" name="check-all-razas" id="check-all-razas">
				<span class="tooltip">Seleccionar todo</span>
			</th>
			<th>Raza</th>
			<th>Especie</th>
		</tr>
			<?php 
				foreach($razas as $key => $value) : 
				$especie = ControladorMascota::seleccionarEspecieByRazaCtl($value["idmascota_especie"]);
			?>
		<tr>
			<td>
				<input type="checkbox" name="check-raza" id="check-raza<?=$value["idmascota_raza"]?>" value="<?=$value["idmascota_raza"]?>">
				<span class="tooltip">Seleccionar</span>
			</td>
			<td name="razas-table"><?=$value["raza"]?></td>
			<td name="razas-table"><?=$especie["especie"]?></td>
		</tr>
			<?php endforeach ?>
	</table>

	<div class="C__f oculto" id="form-edit-raza">
		<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-raza" value="x">
			<h2 class="f__title">Editar Raza</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<label class="i-b w100 label-checkbox">Especie</label>
				<?php foreach ($especies as $key => $value) : ?>
					<input 
						type="radio" 
						name="raza-especie-edit" 
						id="raza-<?=$value['especie']?>-edit" 
						value="<?=$value['idmascota_especie']?>" 
						required>
					<label 
						class="label-radio" 
						for="raza-<?=$value['especie']?>-edit">
						<?=$value['especie']?>
						</label>
				<?php endforeach ?>
			</div>

			<div class="i__group">
				<input class="inputs" type="text" id="raza-nombre-edit" name="raza-nombre-edit" required>
				<label class="labels" for="raza-nombre-edit">Raza</label>
			</div>

			<input type="hidden" name="razaId-edit" id="razaId-edit" required>
			<input class="submit" type="submit" value="Actualizar">
			<?php ControladorMascota::actualizarRazaCtl(); ?>
		</form>
	</div>
	
	<div class="C__f oculto" id="form-delete-raza">
		<form method="post" class="f">
			<input class="f__close" type="button" id="btn-close-form-delete-raza" value="x">
			<h2 class="f__title">Confirmación</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
			</div>
			<div class="D-info">
				<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
			</div>
			<input class="submit" type="button" id="btn-C-delete-raza" value="Confirmar">
		</form>
	</div>
	<?php } ?>
	<div class="C__f oculto" id="form-add-raza">
		<form method="post" class="f">
			<input class="f__close" type="button" id="btn-close-form-add-raza" value="x">
			<h2 class="f__title">Agregar Raza</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<label class="i-b w100 label-checkbox">Especie</label>
				<?php foreach ($especies as $key => $value) : ?>
					<input 
						type="radio" 
						name="raza-especie-new" 
						id="raza-<?=$value['especie']?>-new" 
						value="<?=$value['idmascota_especie']?>" 
						required>
					<label 
						class="label-radio" 
						for="raza-<?=$value['especie']?>-new">
						<?=$value['especie']?>
						</label>
				<?php endforeach ?>
			</div>
			
			<div class="i__group">
				<input class="inputs" type="text" id="raza-nombre-new" name="raza-nombre-new" required>
				<label class="labels" for="raza-nombre-new">Raza</label>
			</div>

			<input class="submit" type="submit" value="Agregar">
			<?php ControladorMascota::nuevaRazaCtl(); ?>
		</form>
	</div>
</div>
<?php } ?>
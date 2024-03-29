<?php 
	$nameGET = $_GET['uc'];

	$cliente = ControladorCliente::datosClienteCtl($nameGET);
	$clienteCorreos = Controlador::seleccionarCorreosCtl($nameGET);
	$clienteTelefonos = Controlador::seleccionarTelefonosCtl($nameGET);
	$clienteDomicilios = Controlador::seleccionarDomiciliosCtl($nameGET);
	$clienteMascotas = ControladorCliente::misMascotasCtl($nameGET);

	$correoPrincipal = MainInfo::obtenerCorreoPrincipal($clienteCorreos);
	$telefonoPrincipal = MainInfo::obtenerTelefonoPrincipal($clienteTelefonos);
	$domicilioPrincipal = MainInfo::obtenerDomicilioPrincipal($clienteDomicilios);
?>
<div class="title">
	<h2>Clientes</h2>
	<h3><?=$cliente["cliente"]?></h3>
	<input type="hidden" name="clientId" id="clientId" value="<?=$cliente["iduser"]?>">
</div>

<div class="C__F" id="form-card-client">
	<div class="Cards w70">
		<div class="Cards__Contentinfo">
			<div class="Cards__logo">
				<img src="img/pet_50px.png" alt="Pet">
			</div>
			<div class="Cards__info">
				<h3 id="Cards-user-name"><?=substr($cliente["cliente"], 0, 25)?></h3>
			</div>
		</div>
		
		<div class="Cards__main">
			<h4>Información principal</h4>
			<div>
				<span>Correo electrónico:</span>
				<span><?= $correoPrincipal ?></span>
			</div>
			<div>
				<span>Teléfono:</span>
				<span><?= $telefonoPrincipal ?></span>
			</div>
			<div>
				<span>Domicilio:</span>
				<span><?= $domicilioPrincipal ?></span>
			</div>
		</div>
		
		<div class="Cards__main">
			<h4>Mis Mascotas</h4>
			<div>
				<?php foreach ($clienteMascotas as $k => $v) : ?>
				<a class="info" href="index.php?pagina=Mascota&um=<?=$v["idmascota"]?>"><?= $v["mascota"] ?></a>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="Cards__tabs" name="Información de contacto">
			<div class="tabs">
				<a href="#tab-client-emails">Correos electrónicos</a>
				<a href="#tab-client-phones">Teléfonos</a>
				<a href="#tab-client-address">Domicilios</a>
			</div>
			<div name="tabs-content">
				<div id="tab-client-emails" class="ficha__info">
					<div class="C__Btn">
						<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-email">
						<span class="tooltip">Agregar Correo Electrónico</span>
					</div>
					<?php if($clienteCorreos == null) : ?>
						<div class="nodata"><span>Aún no hay registros</span></div>
					<?php else : ?>
						<div class="C__Btn">
							<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-email" disabled>
							<span class="tooltip">Editar Correo Electrónico</span>
						</div>
						<div class="C__Btn">
							<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-email" disabled>
							<span class="tooltip">Borrar Correo Electrónico</span>
						</div>
						<div class="C__Btn">
							<input 
								id="btn-asmain-email" 
								class="buttonSmall" 
								type="submit" 
								value="Establecer como principal" disabled>
						</div>
						<div class="C__Btn__Last">
							<span><?=sizeof($clienteCorreos)?> / 5</span>
						</div>
						<table class="table" id="tbl-client-emails">
							<tr>
								<th>
									<input type="checkbox" name="check-all-client-emails" id="check-all-client-emails">
									<span class="tooltip">Seleccionar todo</span>
								</th>
								<th>Correo electrónico</th>
							</tr>
							<?php foreach ($clienteCorreos as $key => $value) : ?>
							<tr>
								<td>
									<input type="checkbox" name="check-client-email" id="check-client-email<?=$value["iduser_correo"]?>" value="<?=$value["iduser_correo"]?>">
									<span class="tooltip">Seleccionar</span>
								</td>
								<td>
									<?php if($value["status"] == 2) : ?>
										<img class="iconJoin" src="img/crown2_20px.png" alt="imagen de elemento principal">
									<?php endif ?>
									<span><?=$value["correo"]?></span>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
				<div id="tab-client-phones" class="ficha__info">
					<div class="C__Btn">
						<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-phone">
						<span class="tooltip">Agregar Teléfono</span>
					</div>
					<?php if ($clienteTelefonos == null) : ?>
						<div class="nodata"><span>Aún no hay registros</span></div>
					<?php else : ?>
						<div class="C__Btn">
							<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-phone" disabled>
							<span class="tooltip">Editar Teléfono</span>
						</div>
						<div class="C__Btn">
							<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-phone" disabled>
							<span class="tooltip">Borrar Teléfono</span>
						</div>
						<div class="C__Btn">
							<input 
								id="btn-asmain-phone" 
								class="buttonSmall" 
								type="submit" 
								value="Establecer como principal" disabled>
						</div>
						<div class="C__Btn__Last">
							<span><?=sizeof($clienteTelefonos)?> / 5</span>
						</div>
						<table class="table" id="tbl-client-phones">
							<tr>
								<th>
									<input type="checkbox" name="check-all-client-phones" id="check-all-client-phones">
									<span class="tooltip">Seleccionar todo</span>
								</th>
								<th>Número</th>
							</tr>
							<?php foreach ($clienteTelefonos as $key => $value) : ?>
								<?php switch ($value["tipo"]){
									case 1: $tipo = "Móvil"; break;
									case 2: $tipo = "Casa"; break;
									case 3: $tipo = "Trabajo"; break;
									default: $tipo = "Sin tipo"; break;
								} ?>
								<tr>
									<td>
										<input type="checkbox" name="check-client-phone" id="check-client-phone<?=$value["iduser_telefono"]?>" value="<?=$value["iduser_telefono"]?>">
										<span class="tooltip">Seleccionar</span>
									</td>
									<td>
										<?php if($value["status"] == 2) : ?>
											<img class="iconJoin" src="img/crown2_20px.png" alt="imagen de elemento principal">
										<?php endif ?>
										<span><?=$value["numero"]?> (<?=$tipo?>)</span>
									</td>
								</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
				<div id="tab-client-address" class="ficha__info">
					<div class="C__Btn">
						<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-client-address">
						<span class="tooltip">Agregar domicilio</span>
					</div>
					<?php if($clienteDomicilios == null) : ?>
						<div class="nodata"><span>Aún no hay registros</span></div>
					<?php else : ?>
						<div class="C__Btn">
							<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-client-address" disabled>
							<span class="tooltip">Editar domicilio</span>
						</div>
						<div class="C__Btn">
							<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-client-address" disabled>
							<span class="tooltip">Borrar domicilio</span>
						</div>
						<div class="C__Btn">
							<input 
								id="btn-asmain-address" 
								class="buttonSmall" 
								type="submit" 
								value="Establecer como principal" disabled>
						</div>
						<div class="C__Btn__Last">
							<span><?=sizeof($clienteDomicilios)?> / 5</span>
						</div>
						<table class="table" id="tbl-client-address">
							<tr>
								<th>
									<input type="checkbox" name="check-all-client-address" id="check-all-client-address">
									<span class="tooltip">Seleccionar todo</span>
								</th>
								<th>Domicilio</th>
							</tr>
							<?php foreach ($clienteDomicilios as $key => $value) : ?>
							<tr>
								<td>
									<input type="checkbox" name="check-client-address" id="check-client-address<?=$value["iduser_domicilio"]?>" value="<?=$value["iduser_domicilio"]?>">
									<span class="tooltip">Seleccionar</span>
								</td>
								<td>
									<?php if($value["status"] == 2) : ?>
										<img class="iconJoin" src="img/crown2_20px.png" alt="imagen de elemento principal">
									<?php endif ?>
									<span><?=$value["calle"]?>, #<?=$value["num_casaex"]?>, <?=$value["colonia"]?></span>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="C__f oculto" id="form-add-client-email">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-add-client-email" value="x">
		<h2 class="f__title">Nuevo correo electrónico</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="inputs" type="email" id="correo-new" name="correo-new" required>
			<label class="labels" for="correo-new">Correo Electrónico</label>
		</div>

		<input type="hidden" id="add-email-id" name="add-email-id" value="<?=$cliente["iduser"]?>" required>
		<input class="submit" type="submit" value="Crear">
		<?php Controlador::nuevoCorreoCtl(); ?>
	</form>
</div>

<div class="C__f oculto" id="form-edit-client-email">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-client-email" value="x">
		<h2 class="f__title">Actualizar correo electrónico</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="inputs" type="email" id="correo-edit" name="correo-edit" required>
			<label class="labels" for="correo-edit">Correo Electrónico</label>
		</div>

		<input type="hidden" id="correo-id-edit" name="correo-id-edit" required>
		<input class="submit" type="submit" value="Actualizar">
		<?php Controlador::actualizarCorreoCtl($cliente["iduser"]); ?>
	</form>
</div>

<div class="C__f oculto" id="form-delete-client-email">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-delete-client-email" value="x">
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
		</div>
		<input class="submit" type="button" id="btn-C-delete-client-email" value="Confirmar">
	</form>
</div>

<div class="C__f oculto" id="form-add-client-phone">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-add-client-phone" value="x">
		<h2 class="f__title">Nuevo número telefónico</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="inputs" type="text" id="telefono-new" name="telefono-new" required>
			<label class="labels" for="telefono-new">Número</label>
		</div>
		
		<div class="i__group">
			<label class="label-checkbox" for="tipotelefono-new">Tipo</label>
			<select name="tipotelefono-new" id="tipotelefono-new" required>
				<option value="">Seleccione el tipo de teléfono</option>
				<option value="1">Móvil</option>
				<option value="2">Casa</option>
				<option value="3">Trabajo</option>
			</select>
		</div>
		
		<input type="hidden" id="add-phone-id" name="add-phone-id" value="<?=$cliente["iduser"]?>" required>
		<input class="submit" type="submit" value="Crear">
		<?php Controlador::nuevoTelefonoCtl(); ?>
	</form>
</div>

<div class="C__f oculto" id="form-edit-client-phone">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-client-phone" value="x">
		<h2 class="f__title">Actualizar número telefónico</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="inputs" type="text" id="telefono-edit" name="telefono-edit" required>
			<label class="labels" for="telefono-edit">Número</label>
		</div>
		
		<div class="i__group">
			<label class="labels" for="tipotelefono-edit">Tipo</label>
			<select name="tipotelefono-edit" id="tipotelefono-edit" required>
				<option value="">Seleccione el tipo de teléfono</option>
				<option value="1">Móvil</option>
				<option value="2">Casa</option>
				<option value="3">Trabajo</option>
			</select>
		</div>
		
		<input type="hidden" id="phone-id-edit" name="phone-id-edit" required>
		<input class="submit" type="submit" value="Actualizar">
		<?php Controlador::actualizarTelefonoCtl($cliente["iduser"]); ?>
	</form>
</div>

<div class="C__f oculto" id="form-delete-client-phone">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-delete-client-phone" value="x">
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
		</div>
		<input class="submit" type="button" id="btn-C-delete-client-phone" value="Confirmar">
	</form>
</div>

<div class="C__f oculto" id="form-add-client-address">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-add-client-address" value="x">
		<h2 class="f__title">Buscar mi domicilio</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<label for="domicilio-ubicacion-new" class="labels">Buscar mi ubicación</label>
			<input class="inputs" type="text" id="domicilio-ubicacion-new" name="domicilio-ubicacion-new" placeholder="Colonia, Municipio" autofocus>
		</div>

		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-estado-new" name="domicilio-estado-new" required>
			<label class="labels" for="domicilio-estado-new">Estado</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-municipio-new" name="domicilio-municipio-new" required>
			<label class="labels" for="domicilio-municipio-new">Municipio</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-colonia-new" name="domicilio-colonia-new" required>
			<label class="labels" for="domicilio-colonia-new">Colonia</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-calle-new" name="domicilio-calle-new" required>
			<label class="labels" for="domicilio-calle-new">Calle</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-numero-e-new" name="domicilio-numero-e-new" required>
			<label class="labels" for="domicilio-numero-e-new">Número exterior</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-numero-i-new" name="domicilio-numero-i-new">
			<label class="labels" for="domicilio-numero-i-new">Número interior / Departamento (opcional)</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-calle1-new" name="domicilio-calle1-new">
			<label class="labels" for="domicilio-calle1-new">Calle 1</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-calle2-new" name="domicilio-calle2-new">
			<label class="labels" for="domicilio-calle2-new">Calle 2</label>
		</div>
		
		<div class="i__group">
			<textarea type="text" id="domicilio-referencia-new" name="domicilio-referencia-new" required></textarea>
			<label class="labels" for="domicilio-referencia-new">Descripción para encontrar su domicilio</label>
		</div>
		
		<input type="hidden" name="add-address-id" id="add-address-id" value="<?=$cliente["iduser"]?>" required>
		<input class="submit" type="submit" value="Crear">
		<?php Controlador::nuevoDomicilioCtl(); ?>
	</form>
</div>

<div class="C__f oculto" id="form-edit-client-address">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-client-address" value="x">
		<h2 class="f__title">Buscar mi domicilio</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<label for="domicilio-ubicacion-edit" class="labels">Buscar mi ubicación</label>
			<input class="inputs" type="text" id="domicilio-ubicacion-edit" name="domicilio-ubicacion-edit" placeholder="Colonia, Municipio" autofocus>
		</div>

		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-estado-edit" name="domicilio-estado-edit" required>
			<label class="labels" for="domicilio-estado-edit">Estado</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-municipio-edit" name="domicilio-municipio-edit" required>
			<label class="labels" for="domicilio-municipio-edit">Municipio</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-colonia-edit" name="domicilio-colonia-edit" required>
			<label class="labels" for="domicilio-colonia-edit">Colonia</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-calle-edit" name="domicilio-calle-edit" required>
			<label class="labels" for="domicilio-calle-edit">Calle</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-numero-e-edit" name="domicilio-numero-e-edit" required>
			<label class="labels" for="domicilio-numero-e-edit">Número exterior</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-numero-i-edit" name="domicilio-numero-i-edit">
			<label class="labels" for="domicilio-numero-i-edit">Número interior / Departamento (opcional)</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-calle1-edit" name="domicilio-calle1-edit">
			<label class="labels" for="domicilio-calle1-edit">Calle 1</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="text" id="domicilio-calle2-edit" name="domicilio-calle2-edit">
			<label class="labels" for="domicilio-calle2-edit">Calle 2</label>
		</div>
		
		<div class="i__group">
			<textarea type="text" id="domicilio-referencia-edit" name="domicilio-referencia-edit" required></textarea>
			<label class="labels" for="domicilio-referencia-edit">Descripción para encontrar su domicilio</label>
		</div>
		
		<input type="hidden" name="address-id-edit" id="address-id-edit" required>
		<input class="submit" type="submit" value="Actualizar">
		<?php Controlador::actualizarDomicilioCtl($cliente["iduser"]); ?>
	</form>
</div>

<div class="C__f oculto" id="form-delete-client-address">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-delete-client-address" value="x">
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
		</div>
		<input class="submit" type="button" id="btn-C-delete-client-address" value="Confirmar">
	</form>
</div>

<div class="C__f oculto" id="form-asmain-element">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-asmain-element" value="x">
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea establecer este dato como principal?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> Aparecerá el siguiente ícono al lado del elemento principal 
				<img src="img/crown2_20px.png" alt="imagen de elemento principal">
			</p>
			<input type="hidden" name="asmain-element" id="asmain-element" required>
		</div>
		<input class="submit" type="button" id="btn-C-asmain-element" value="Confirmar">
	</form>
</div>
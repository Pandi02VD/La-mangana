<?php 
	$nameGET = 'uu';
	
	$usuario = ControladorUsuario::datosUsuarioCtl($_GET[$nameGET]);
	$usuarioCorreos = Controlador::seleccionarCorreosCtl($_GET[$nameGET]);
	$usuarioTelefonos = Controlador::seleccionarTelefonosCtl($_GET[$nameGET]);
	$usuarioDomicilios = Controlador::seleccionarDomiciliosCtl($_GET[$nameGET]);
?>
<div class="title">
	<h2>Usuarios</h2>
	<h3><?=$usuario["nombre"]?></h3>
	<input type="hidden" name="userId" id="userId" value="<?=$usuario["iduser"]?>">
</div>

<div class="C__F" id="form-card-user">
	<div class="Cards">
		<div><span name="Card-user-name"></span></div>
		<div class="C__Btn">
			<input 
				id="btn-change-password" 
				style="font-size: 14px; padding: 4px 10px; margin-bottom: 10px" 
				class="submit" 
				type="submit" 
				value="Cambiar contraseña">
		</div>
		<div>
			<div class="tabs">
				<a href="#tab-user-emails">Correos electrónicos</a>
				<a href="#tab-user-phones">Teléfonos</a>
				<a href="#tab-user-address">Domicilios</a>
			</div>
			<div name="tabs-content">
				<div id="tab-user-emails" class="ficha__info">
					<div class="C__Btn">
						<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-user-email">
						<span class="tooltip">Agregar Correo Electrónico</span>
					</div>
					<?php if($usuarioCorreos == null) : ?>
						<div class="nodata"><span>Aún no hay registros</span></div>
					<?php else : ?>
						<div class="C__Btn">
							<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-user-email" disabled>
							<span class="tooltip">Editar Correo Electrónico</span>
						</div>
						<div class="C__Btn">
							<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-user-email" disabled>
							<span class="tooltip">Borrar Correo Electrónico</span>
						</div>
						<table class="table" id="tbl-user-emails">
							<caption>Correos electrónicos</caption>
							<tr>
								<th>
									<input type="checkbox" name="check-all-user-emails" id="check-all-user-emails">
									<span class="tooltip">Seleccionar todo</span>
								</th>
								<th>Correo electrónico</th>
							</tr>
							<?php foreach ($usuarioCorreos as $key => $value) : ?>
							<tr>
								<td>
									<input type="checkbox" name="check-user-email" id="check-user-email<?=$value["iduser_correo"]?>" value="<?=$value["iduser_correo"]?>">
									<span class="tooltip">Seleccionar</span>
								</td>
								<td><?=$value["correo"]?></td>
							</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
				<div id="tab-user-phones" class="ficha__info">
					<div class="C__Btn">
						<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-user-phone">
						<span class="tooltip">Agregar Teléfono</span>
					</div>
					<?php if ($usuarioTelefonos == null) : ?>
						<div class="nodata"><span>Aún no hay registros</span></div>
					<?php else : ?>
						<div class="C__Btn">
							<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-user-phone" disabled>
							<span class="tooltip">Editar Teléfono</span>
						</div>
						<div class="C__Btn">
							<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-user-phone" disabled>
							<span class="tooltip">Borrar Teléfono</span>
						</div>
						<table class="table" id="tbl-user-phones">
							<caption>Teléfonos</caption>
							<tr>
								<th>
									<input type="checkbox" name="check-all-user-phones" id="check-all-user-phones">
									<span class="tooltip">Seleccionar todo</span>
								</th>
								<th>Número</th>
								<th>Tipo</th>
							</tr>
							<?php foreach ($usuarioTelefonos as $key => $value) : ?>
								<?php switch ($value["tipo"]){
									case 1: $tipo = "Móvil"; break;
									case 2: $tipo = "Casa"; break;
									case 3: $tipo = "Trabajo"; break;
									default: $tipo = "Sin tipo"; break;
								} ?>
								<tr>
									<td>
										<input type="checkbox" name="check-user-phone" id="check-user-phone<?=$value["iduser_telefono"]?>" value="<?=$value["iduser_telefono"]?>">
										<span class="tooltip">Seleccionar</span>
									</td>
									<td><?=$value["numero"]?></td>
									<td><?=$tipo?></td>
								</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
				<div id="tab-user-address" class="ficha__info">
					<div class="C__Btn">
						<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-user-address">
						<span class="tooltip">Agregar domicilio</span>
					</div>
					<?php if($usuarioDomicilios == null) : ?>
						<div class="nodata"><span>Aún no hay registros</span></div>
					<?php else : ?>
						<div class="C__Btn">
							<input type="image" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-user-address" disabled>
							<span class="tooltip">Editar domicilio</span>
						</div>
						<div class="C__Btn">
							<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-user-address" disabled>
							<span class="tooltip">Borrar domicilio</span>
						</div>
						<table class="table" id="tbl-user-address">
							<caption>Domicilios</caption>
							<tr>
								<th>
									<input type="checkbox" name="check-all-user-address" id="check-all-user-address">
									<span class="tooltip">Seleccionar todo</span>
								</th>
								<th>Domicilio</th>
							</tr>
							<?php foreach ($usuarioDomicilios as $key => $value) : ?>
							<tr>
								<td>
									<input type="checkbox" name="check-user-address" id="check-user-address<?=$value["iduser_domicilio"]?>" value="<?=$value["iduser_domicilio"]?>">
									<span class="tooltip">Seleccionar</span>
								</td>
								<td><?=$value["calle"]?>, #<?=$value["num_casaex"]?>, <?=$value["colonia"]?></td>
							</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="C__f oculto" id="form-add-user-email">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-add-user-email" value="x">
		<h2 class="f__title">Nuevo correo electrónico</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="inputs" type="email" id="correo-new" name="correo-new" required>
			<label class="labels" for="correo-new">Correo Electrónico</label>
		</div>

		<input type="hidden" id="add-email-id" name="add-email-id" value="<?=$usuario["iduser"]?>" required>
		<input class="submit" type="submit" value="Crear">
		<?php Controlador::nuevoCorreoCtl(); ?>
	</form>
</div>

<div class="C__f oculto" id="form-edit-user-email">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-user-email" value="x">
		<h2 class="f__title">Actualizar correo electrónico</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="inputs" type="email" id="correo-edit" name="correo-edit" required>
			<label class="labels" for="correo-edit">Correo Electrónico</label>
		</div>

		<input type="hidden" id="correo-id-edit" name="correo-id-edit" required>
		<input class="submit" type="submit" value="Actualizar">
		<?php Controlador::actualizarCorreoCtl($usuario["iduser"]); ?>
	</form>
</div>

<div class="C__f oculto" id="form-delete-user-email">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-delete-user-email" value="x">
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
		</div>
		<input class="submit" type="button" id="btn-C-delete-user-email" value="Confirmar">
	</form>
</div>

<div class="C__f oculto" id="form-add-user-phone">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-add-user-phone" value="x">
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
		
		<input type="hidden" id="add-phone-id" name="add-phone-id" value="<?=$usuario["iduser"]?>" required>
		<input class="submit" type="submit" value="Crear">
		<?php Controlador::nuevoTelefonoCtl(); ?>
	</form>
</div>

<div class="C__f oculto" id="form-edit-user-phone">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-user-phone" value="x">
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
		<?php Controlador::actualizarTelefonoCtl($usuario["iduser"]); ?>
	</form>
</div>

<div class="C__f oculto" id="form-delete-user-phone">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-delete-user-phone" value="x">
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
		</div>
		<input class="submit" type="button" id="btn-C-delete-user-phone" value="Confirmar">
	</form>
</div>

<div class="C__f oculto" id="form-add-user-address">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-add-user-address" value="x">
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
		
		<input type="hidden" name="add-address-id" id="add-address-id" value="<?=$usuario["iduser"]?>" required>
		<input class="submit" type="submit" value="Crear">
		<?php Controlador::nuevoDomicilioCtl(); ?>
	</form>
</div>

<div class="C__f oculto" id="form-edit-user-address">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-user-address" value="x">
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
		<?php Controlador::actualizarDomicilioCtl($usuario["iduser"]); ?>
	</form>
</div>

<div class="C__f oculto" id="form-delete-user-address">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-delete-user-address" value="x">
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
		</div>
		<input class="submit" type="button" id="btn-C-delete-user-address" value="Confirmar">
	</form>
</div>

<div class="C__f oculto" id="form-change-password">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-change-password" value="x">
		<h2 class="f__title">Actualizar contraseña</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="inputs" type="password" id="contrasena-old" name="contrasena-old" required>
			<label class="labels" for="contrasena-old">Contraseña Anterior</label>
		</div>
		
		<div class="i__group">
			<input class="inputs" type="password" id="contrasena-edit" name="contrasena-edit" required>
			<label class="labels" for="contrasena-edit">Contraseña nueva</label>
		</div>

		<input type="hidden" id="usuarioId" name="usuarioId" value="<?=$usuario["iduser"]?>" required>
		<input class="submit" type="submit" value="Actualizar">
		<?php ControladorUsuario::actualizarPicCtl(); ?>
	</form>
</div>
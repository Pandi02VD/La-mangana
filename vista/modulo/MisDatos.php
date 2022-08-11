<?php
	$idUsuario = $_SESSION["usuario"];
	$telefonos = Controlador::selTelefonosCtl($idUsuario);
	$correos = Controlador::selCorreosCtl($idUsuario);
	$domicilios = Controlador::selDomiciliosCtl($idUsuario);
	$tipoTel = DataArrays::getTipoTel();
	$eCorreo = "";
	$eTel = "";
	$eDom = "";
?>
<div class="title">
	<h2>Mis Datos</h2>
</div>

<div class="C__Table center">
	<div class="info msg column w70">
		<span>Elemento principal(<b class="principal">*</b>)</span>
	</div>
	<div class="Bar__Btns column w70">
		<span class="subtitle center">Teléfono</span>
		<div class="C__Btn">
			<input type="button" id="telefonoNBtn-s" class="btn" value=" + Agregar teléfono">
		</div>
		<?php if (!$telefonos) : ?>
			<div class="info nodata"><span>No hay teléfonos registrados</span></div>
		<?php else : foreach ($telefonos as $key => $value) : ?>
		<?php $value["estado"] == 2 ? $eTel = "*" : $eTel = ""; ?>
			<div class="lista">
				<div class="listaItem">
					<div>
						<b class="principal"><?=$eTel?></b>
						<span><?=$value["numero"]?></span>
					</div>
					<div>
						<input class="btn link" id="<?=$value["idUsuarioTelefono"]?>" name="telefonoABtn-s" type="button" value="Actualizar">
						<input class="btn link" id="<?=$value["idUsuarioTelefono"]?>" name="telefonoEBtn-s" type="button" value="Eliminar">
					</div>
				</div>
			</div>
		<?php endforeach; endif; ?>
	</div>
	
	<div class="Bar__Btns column w70">
		<span class="subtitle center">Correo electrónico</span>
		<div class="C__Btn">
			<input type="button" id="correoNBtn-s" class="btn" value=" + Agregar Correo electrónico">
		</div>
		<?php if (!$correos) :  ?>
			<div class="info nodata"><span>No hay Correos electrónicos registrados</span></div>
		<?php else : foreach ($correos as $key => $value) : ?>
		<?php $value["estado"] == 2 ? $eCorreo = "*" : $eCorreo = "" ?>
			<div class="lista">
				<div class="listaItem">
					<div>
						<b class="principal"><?=$eCorreo?></b>
						<span><?=$value["correo"]?></span>
					</div>
					<div>
						<input class="btn link" id="<?=$value["idUsuarioCorreo"]?>" name="correoABtn-s" type="button" value="Actualizar">
						<input class="btn link" id="<?=$value["idUsuarioCorreo"]?>" name="correoEBtn-s" type="button" value="Eliminar">
					</div>
				</div>
			</div>
		<?php endforeach; endif; ?>
	</div>
	
	<div class="Bar__Btns column w70">
		<span class="subtitle center">Domicilio</span>
		<div class="C__Btn">
			<input type="button" id="domicilioNBtn-s" class="btn" value=" + Agregar domicilio">
		</div>
		<?php if (!$domicilios) :  ?>
			<div class="info nodata"><span>No hay domicilios registrados</span></div>
		<?php else : foreach ($domicilios as $key => $value) : ?>
		<?php $value["estado"] == 2 ? $eDom = "*" : $eDom = "" ?>
		<?php 
			$domJSON = json_decode($value["domicilioJSON"]); 
			$domicilio = $domJSON->calle.", ".
				(!$domJSON->numExt ? 'S/N' : "#".$domJSON->numExt).", ".
				$domJSON->colonia.", ".$domJSON->municipio.", ".$domJSON->estado;
		?>
			<div class="lista">
				<div class="listaItem">
					<div>
						<b class="principal"><?=$eDom?></b>
						<span><?=$domicilio?></span>
					</div>
					<div>
						<input class="btn link" id="<?=$value["idUsuarioDomicilio"]?>" name="domicilioABtn-s" type="button" value="Actualizar">
						<input class="btn link" id="<?=$value["idUsuarioDomicilio"]?>" name="domicilioEBtn-s" type="button" value="Eliminar">
					</div>
				</div>
			</div>
		<?php endforeach; endif; ?>
	</div>
</div>

<div class="C__f oculto" id="telefonoAForm">
	<form method="post" class="f">
		<span class="f__x" id="telefonoABtn-x"></span>
		<h2 class="f__title">Actualizar Teléfono</h2>
		<div class="i__group">
			<input class="textfield" type="tel" name="telNumero-a" id="telNumero-a" required>
			<label class="labels" for="telNumero-a">Número de teléfono</label>
		</div>
		
		<div class="i__group">
			<select name="telTipo-a" id="telTipo-a">
				<?php foreach($tipoTel as $key => $value) : ?>
					<option value="<?=$key?>"><?=$value?></option>
				<?php endforeach ?>
			</select>
			<label class="labels" for="telTipo-a">Tipo de teléfono</label>
		</div>
		<div>
			<input type="hidden" name="telId-a" id="telId-a" value="">
			<input class="submit" type="submit" value="Guardar">
			<?php Controlador::actualizarTelefonoCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="correoAForm">
	<form method="post" class="f">
		<span class="f__x" id="correoABtn-x"></span>
		<h2 class="f__title">Actualizar Correo Electrónico</h2>
		<div class="i__group">
			<input class="textfield" type="email" name="correo-a" id="correo-a" required>
			<label class="labels" for="correo-a">Correo electrónico</label>
		</div>
		<div>
			<input type="hidden" name="correoId-a" id="correoId-a" value="">
			<input class="submit" type="submit" value="Guardar">
			<?php Controlador::actualizarCorreoCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="domicilioAForm">
	<form method="post" class="f fBig">
		<span class="f__x" id="domicilioABtn-x"></span>
		<h2 class="f__title">Actualizar Domicilio</h2>
		<div class="i__group">
			<input class="textfield type="text" name="domUbicacion-a" id="domUbicacion-a">
			<label class="labels" for="domUbicacion-a">Buscar Ubicación</label>
		</div>
		<div class="C__group">Ubicación
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domEstado-a" id="domEstado-a" required>
					<label class="labels" for="domEstado-a">Entidad Federativa</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="text" name="domMunicipio-a" id="domMunicipio-a" required>
					<label class="labels" for="domMunicipio-a">Municipio</label>
				</div>
			</div>
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domColonia-a" id="domColonia-a" required>
					<label class="labels" for="domColonia-a">Colonia</label>
				</div>
			</div>
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domCalle-a" id="domCalle-a" required>
					<label class="labels" for="domCalle-a">Calle</label>
				</div>
			</div>
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domNumExt-a" id="domNumExt-a" required>
					<label class="labels" for="domNumExt-a">Número de casa o Exterior</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="text" name="domNumInt-a" id="domNumInt-a">
					<label class="labels" for="domNumInt-a">Número de Departamiento o Interior</label>
				</div>
			</div>
		</div>
		<div class="C__group">Entre Calles
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domCalle1-a" id="domCalle1-a">
					<label class="labels" for="domCalle1-a">Calle 1</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="text" name="domCalle2-a" id="domCalle2-a">
					<label class="labels" for="domCalle2-a">Calle 2</label>
				</div>
			</div>
		</div>
		<div class="i__group">
			<input class="textfield" type="text" name="domRef-a" id="domRef-a" required>
			<label class="labels" for="domRef-a">Indicaciones para llegar a su domicilio</label>
		</div>
		<div>
			<input type="hidden" name="domId-a" id="domId-a" value="">
			<input class="submit" type="submit" value="Guardar">
			<?php Controlador::actualizarDomicilioCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="telefonoEForm">
	<form method="post" class="f">
		<span class="f__x" id="telefonoEBtn-x"></span>
		<h2 class="f__title">Eliminar Telefono</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Eliminar el Teléfono seleccionado?</span>
		</div>
		<div>
			<input type="hidden" name="telId-e" id="telId-e" value="">
			<input class="submit" type="submit" value="Aceptar">
			<?php Controlador::eliminarTelefonoCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="correoEForm">
	<form method="post" class="f">
		<span class="f__x" id="correoEBtn-x"></span>
		<h2 class="f__title">Eliminar Correo Electrónico</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Eliminar el correo electrónico seleccionado?</span>
		</div>
		<div>
			<input type="hidden" name="correoId-e" id="correoId-e" value="">
			<input class="submit" type="submit" value="Aceptar">
			<?php Controlador::eliminarCorreoCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="domicilioEForm">
	<form method="post" class="f">
		<span class="f__x" id="domicilioEBtn-x"></span>
		<h2 class="f__title">Eliminar Domicilio</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Eliminar el domicilio seleccionado?</span>
		</div>
		<div>
			<input type="hidden" name="domId-e" id="domId-e" value="">
			<input class="submit" type="submit" value="Aceptar">
			<?php Controlador::eliminarDomicilioCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="telefonoNForm">
	<form method="post" class="f">
		<span class="f__x" id="telefonoNBtn-x"></span>
		<h2 class="f__title">Nuevo Teléfono</h2>
		<div class="i__group">
			<input class="textfield" type="tel" name="telNumero-n" id="telNumero-n" required>
			<label class="labels" for="telNumero-n">Número de teléfono</label>
		</div>
		<div class="i__group">
			<select name="telTipo-n" id="telTipo-n">
				<option value="1">Móvil</option>
				<option value="2">Casa</option>
				<option value="3">Trabajo</option>
			</select>
			<label class="labels" for="telTipo-n">Tipo de teléfono</label>
		</div>
		<div>
			<input type="hidden" name="telIdPersona-n" id="telIdPersona-n" value="<?=$idUsuario?>">
			<input class="submit" type="submit" value="Guardar">
			<?php Controlador::nuevoTelefonoCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="correoNForm">
	<form method="post" class="f">
		<span class="f__x" id="correoNBtn-x"></span>
		<h2 class="f__title">Nuevo Correo Electrónico</h2>
		<div class="i__group">
			<input class="textfield" type="email" name="correo-n" id="correo-n" required>
			<label class="labels" for="correo-n">Correo electrónico</label>
		</div>
		<div>
			<input type="hidden" name="correoIdPersona-n" id="correoIdPersona-n" value="<?=$idUsuario?>">
			<input class="submit" type="submit" value="Guardar">
			<?php Controlador::nuevoCorreoCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="domicilioNForm">
	<form method="post" class="f fBig">
		<span class="f__x" id="domicilioNBtn-x"></span>
		<h2 class="f__title">Nuevo Domicilio</h2>
		<div class="i__group">
			<input class="textfield type="text" name="domUbicacion-n" id="domUbicacion-n">
			<label class="labels" for="domUbicacion-n">Buscar Ubicación</label>
		</div>
		<div class="C__group">Ubicación
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domEstado-n" id="domEstado-n" required>
					<label class="labels" for="domEstado-n">Entidad Federativa</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="text" name="domMunicipio-n" id="domMunicipio-n" required>
					<label class="labels" for="domMunicipio-n">Municipio</label>
				</div>
			</div>
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domColonia-n" id="domColonia-n" required>
					<label class="labels" for="domColonia-n">Colonia</label>
				</div>
			</div>
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domCalle-n" id="domCalle-n" required>
					<label class="labels" for="domCalle-n">Calle</label>
				</div>
			</div>
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domNumExt-n" id="domNumExt-n" required>
					<label class="labels" for="domNumExt-n">Número de casa o Exterior</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="text" name="domNumInt-n" id="domNumInt-n">
					<label class="labels" for="domNumInt-n">Número de Departamiento o Interior</label>
				</div>
			</div>
		</div>
		<div class="C__group">Entre Calles
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" name="domCalle1-n" id="domCalle1-n">
					<label class="labels" for="domCalle1-n">Calle 1</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="text" name="domCalle2-n" id="domCalle2-n">
					<label class="labels" for="domCalle2-n">Calle 2</label>
				</div>
			</div>
		</div>
		<div class="i__group">
			<input class="textfield" type="text" name="domRef-n" id="domRef-n" required>
			<label class="labels" for="domRef-n">Indicaciones para llegar a su domicilio</label>
		</div>
		<div>
			<input type="hidden" name="domIdPersona-n" id="domIdPersona-n" value="<?=$idUsuario?>">
			<input class="submit" type="submit" value="Guardar">
			<?php Controlador::nuevoDomicilioCtl(); ?>
		</div>
	</form>
</div>
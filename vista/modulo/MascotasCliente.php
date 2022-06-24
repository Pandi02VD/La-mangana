<?php 
	$nameGET = 'um';
	$clienteId = $_GET[$nameGET];
	$cliente = ControladorCliente::seleccionarClienteCtl($clienteId);
	$arrayMascotasCliente = ControladorMascota::mascotasClienteCtl($clienteId);
	$mascotaEspecies = ControladorMascota::seleccionarEspeciesCtl();
	$medicos = ControladorUsuario::medicosCtl();

	$size = 3;
	$init = 0;
	$inicio = 0;
	$modulo = '';
	if(isset($_GET["pag"])){
		$init = $_GET["pag"];
	}
	if(isset($_GET["pagina"])){
		$modulo = $_GET["pagina"];
	}

	$paginacion = Paginacion::pnt($modulo, sizeof($arrayMascotasCliente), $init, $size);
	$paginacion != null ? $inicio = $paginacion['inicio'] : null ;
	$mascotasCliente = array_slice($arrayMascotasCliente, $inicio, $size);
?>
<div class="title">
	<h2>Mascotas</h2>
	<h3>Mascotas de <?= $cliente["cliente"] == null ? '<script>window.location = "index.php?pagina=Error";</script>' : $cliente["cliente"] ;?></h3>
	<input type="hidden" name="clienteId" id="clienteId" value="<?=$clienteId?>">
</div>

<div class="C__Table">
	<?php if ($mascotasCliente == null) { ?>
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
			<span class="tooltip">Agregar mascota</span>
		</div>
		<div class="nodata"><span>Aún no hay registros</span></div>
	<?php }else{ ?>
		<?php if($paginacion != null) : ?>
			<div class="Pnt">
				<a <?=$paginacion['onPrev']?> href="<?=$paginacion['hrefPrev']?>">&#60</a>
				<?php for($i = 1; $i <= $paginacion['pags']; $i++) : ?>
					<a 
						class="<?=$i == $init ? 'active' : ''?>"
						href="index.php?pagina=<?=$modulo?>&pag=<?=$i?>"><?=$i?></a>
				<?php endfor ?>
				<a <?=$paginacion['onNext']?> href="<?=$paginacion['hrefNext']?>">&#62</a>
			</div>
		<?php endif ?>
		<div class="Bar__Btns">
			<div class="C__Btn">
				<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
				<span class="tooltip">Agregar mascota</span>
			</div>
			<div class="C__Btn">
				<input type="image" src="img/stethoscope_32px.png" alt="imágen de acción" id="btn-add-Consult-pet" disabled>
				<span class="tooltip">Consulta</span>
			</div>
			<div class="C__Btn">
				<input type="image" src="img/edit_32px.png" alt="imágen de acción"  id="btn-edit-pet" disabled>
				<span class="tooltip">Editar información de mascota</span>
			</div>
			<div class="C__Btn">
				<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-pet" disabled>
				<span class="tooltip">Borrar mascota</span>
			</div>
			<div class="C__Btn">
				<a href="index.php?pagina=HistoriaClinica">
					<input type="image" src="img/treatment_32px.png" alt="imágen de acción" id="btn-see-HC-pet" disabled>
				</a>
				<span class="tooltip">Ver historial clínico</span>
			</div>
			<div class="C__Btn__Last">
				<input class="inputs box" type="text" id="search-pet" name="search-pet" placeholder="Buscar Mascota">
				<span class="iconSearch"><image src="img/search_20px.png"></image></span>
			</div>
		</div>

		<table class="table" id="tbl-mascotas-cliente">
			<tr>
				<th><input type="checkbox" name="check-all-pets" id="check-all-pets"></th>
				<th>Nombre</th>
				<th>Raza</th>
				<th>Sexo</th>
				<th>Edad (años)</th>
			</tr>
				<?php foreach($mascotasCliente as $key => $value) : ?>
				<?php 
					$raza = ControladorMascota::seleccionarRazaMascotaCtl($value["idmascota_raza"]);
					$currentYear = date("Y");
					
					switch($value["sexo"]){
						case 1: $sexo = "Hembra"; break;
						case 2: $sexo = "Macho"; break;
					}
					
					// switch($value["condicion_corporal"]){
					//     case 1: $cuerpo = "Delgado"; break;
					//     case 2: $cuerpo = "Normal"; break;
					//     case 3: $cuerpo = "Robusto"; break;
					// }
					
					// switch($value["tamano"]){
					//     case 1: $tamano = "Chico"; break;
					//     case 2: $tamano = "Mediano"; break;
					//     case 2: $tamano = "Grande"; break;
					// }
				?>
			<tr>
				<td><input type="checkbox" name="check-pet" id="check-pet<?=$value["idmascota"]?>" value="<?=$value["idmascota"]?>"></td>
				<td id="<?=$value["idmascota"]?>" name="pets-table"><?=$value["mascota"]?></td>
				<td id="<?=$value["idmascota"]?>" name="pets-table"><?=$raza["raza"]?></td>
				<td id="<?=$value["idmascota"]?>" name="pets-table"><?=$sexo?></td>
				<td id="<?=$value["idmascota"]?>" name="pets-table"><?=$currentYear - $value["ano_nacimiento"]?></td>
			</tr>
				<?php endforeach ?>
		</table>
		
		<div class="C__f oculto" id="form-add-Consult-pet">
			<form method="post" class="f">
				<input class="f__close" type="button" id="btn-close-form-add-Consult-pet" value="x">
				<h2 class="f__title">Registro de consulta</h2>
				<div class="line-top"></div>
				<div class="f__datetime">
					<span>Registro: <?=date('d/m/Y - H:i:s');?></span>
					<input type="hidden" id="momento-consult-new" name="momento-consult-new" value="<?=date('Y-m-d H:i:s');?>">
				</div>
				<div class="tabs">
					<a href="#tab-mascota">Datos de la Mascota</a>
					<a href="#tab-propietario">Datos del dueño</a>
				</div>
				<div name="tabs-content">
					<div id="tab-mascota" class="ficha__info">
						<table id="table">
							<tr><td>Nombre: </td><td id="nombre-pet-consult-new"></td></tr>
							<tr><td>Raza: </td><td id="raza-pet-consult-new"></td></tr>
							<tr><td>Sexo: </td><td id="sexo-pet-consult-new"></td></tr>
							<tr><td>Edad: </td><td id="edad-pet-consult-new"></td></tr>
						</table>
					</div>
					
					<div id="tab-propietario" class="ficha__info">
						<table id="table">
							<tr><td>Nombre: </td><td id="nombre-client-consult-new"></td></tr>
							<tr><td>Teléfono: </td><td id="tel-client-consult-new"></td></tr>
							<tr><td>Correo: </td><td id="email-client-consult-new"></td></tr>
							<tr><td>Domicilio: </td><td id="address-client-consult-new"></td></tr>
						</table>
					</div>
				</div>

				<div class="i__group">
					<label class="label-checkbox" for="medico-consult-new">Médico que atendió</label>
					<select name="medico-consult-new" id="medico-consult-new" required>
						<option value="">Seleccione el médico</option>
						<?php foreach ($medicos as $key => $value) : ?>
							<option value="<?=$value["iduser"]?>"><?=$value["nombre"]?></option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="C__group">
					<div class="D-info">
						<p class="info"><i>i</i> Actualice los atributos de la mascota.</p>
					</div>
					
					<div class="i__group">
						<label class="labels" for="peso-pet-consult-new">Peso (Kg)</label>
						<input class="inputs" type="text" id="peso-pet-consult-new" name="peso-pet-consult-new" required>
					</div>
					
					<div class="i__group">
						<label class="i-b w100 label-checkbox">Tamaño</label>
						<input type="radio" name="tamano-pet-consult-new" id="pet-chico-consult-new" value="1" required>
						<label class="label-radio" for="pet-chico-consult-new">Chico</label>
						<input type="radio" name="tamano-pet-consult-new" id="pet-mediano-consult-new" value="2" required>
						<label class="label-radio" for="pet-mediano-consult-new">Mediano</label>
						<input type="radio" name="tamano-pet-consult-new" id="pet-grande-consult-new" value="3" required>
						<label class="label-radio" for="pet-grande-consult-new">Grande</label>
					</div>
					
					<div class="i__group">
						<label class="label-checkbox" for="cc-pet-consult-new">Condición corporal</label>
						<select name="cc-pet-consult-new" id="cc-pet-consult-new" required>
							<option value="">Seleccione la condición corporal</option>
							<option value="1">Delgado</option>
							<option value="2">Normal</option>
							<option value="2">Robusto</option>
						</select>
					</div>
				</div>
				
				<div class="i__group">
					<label class="label-checkbox" for="service-H-consult-new">Motivo de la Consulta</label>
					<div>
						<div id="checkbox">
							<input class="none" type="checkbox" name="service-H-consult-new" id="service-H-consult-new">
							<label for="service-H-consult-new">Hospitalización</label>
							<input class="none" type="checkbox" name="service-C-consult-new" id="service-C-consult-new">
							<label class="none" id="lbl-service-C-consult-new" for="service-C-consult-new">Cirujía</label>
						</div>
						<div id="checkbox">
							<input class="none" type="checkbox" name="service-M-consult-new" id="service-M-consult-new">
							<label id="lbl-service-M-consult-new" for="service-M-consult-new">Solo Medicación</label>
						</div>
					</div>
				</div>

				<div class="C__group">
					<label class="i-b w100 label-checkbox" for="acs-consult-new">Accesorios con los que llega la mascota a la consulta.</label>
					<div class="D-info">
						<p class="info"><i>i</i> Separe con una coma (,) cada accesorio.</p>
					</div>
					<div style="position: relative">
						<input class="inputs" type="text" name="acs-consult-new" id="acs-consult-new">
					</div>
				</div>

				<div class="i__group">
					<label class="labels" for="observaciones-consult-new">Observaciones</label>
					<textarea id="observaciones-consult-new" name="observaciones-consult-new" required></textarea>
				</div>
				
				<div class="i__group">
					<label class="labels" for="costo-consult-new">Costo de Consulta ($ MNX)</label>
					<input class="inputs" type="text" id="costo-consult-new" name="costo-consult-new" required>
				</div>
				
				<input type="hidden" name="pet-id-add-consult" id="pet-id-add-consult" required>
				<input type="submit" id="btn-MF" class="submit" value="Siguiente Paso">
				<?php ControladorServicios::nuevaConsultaCtl(); ?>
			</form>
		</div>

		<div class="C__f oculto" id="form-edit-pet">
			<form method="post" class="f">
				<input class="f__close" type="button" id="btn-close-form-edit-pet" value="x">
				<h2 class="f__title">Editar Mascota de <?=substr($cliente["cliente"], 0, 10)?></h2>
				<div class="line-top"></div>
				<div class="i__group">
					<label class="labels" for="pet-nombre-edit">Nombre</label>
					<input class="inputs" type="text" id="pet-nombre-edit" name="pet-nombre-edit" required autofocus>
					<input type="hidden" name="pet-property-edit" value="<?=$clienteId?>">
				</div>

				<div class="i__group">
					<label class="i-b w100 label-checkbox">Especie</label>
					<?php foreach ($mascotaEspecies as $key => $value) : ?>
						<input 
							type="radio" 
							name="pet-especie-edit" 
							id="pet-<?=$value['especie']?>-edit" 
							value="<?=$value['idmascota_especie']?>" 
							required>
						<label 
							class="label-radio" 
							for="pet-<?=$value['especie']?>-edit">
							<?=$value['especie']?>
							</label>
					<?php endforeach ?>
				</div>

				<div class="i__group">
					<label class="label-checkbox" for="pet-raza-edit">Raza</label>
					<select name="pet-raza-edit" id="pet-raza-edit" required>
						<option value="">Primero seleccione especie</option>
					</select>
				</div>
				
				<div class="i__group">
					<label class="i-b w100 label-checkbox">Sexo</label>
					<input type="radio" name="pet-sexo-edit" id="pet-hembra-edit" value="1" required>
					<label class="label-radio" for="pet-hembra-edit">Hembra</label>
					<input type="radio" name="pet-sexo-edit" id="pet-macho-edit" value="2" required>
					<label class="label-radio" for="pet-macho-edit">Macho</label>
				</div>

				<div class="i__group flex">
					<label class="labels" for="pet-anos-edit">Edad (años)</label>
					<label class="labels left" for="pet-anos-edit">Año de nacimiento</label>
					<input class="inputs" type="text" id="pet-anos-edit" name="pet-anos-edit" required>
					<span class="inputs disabled" id="span-edad-edit"></span>
					<input type="hidden" id="pet-edad-edit" name="pet-edad-edit" required>
				</div>

				<input class="submit" type="submit" value="Actualizar">
				<input type="hidden" name="petId-edit" id="petId-edit">
				<?php ControladorMascota::actualizarMascotaCtl(); ?>
			</form>
		</div>

		<div class="C__f oculto" id="form-delete-pet">
			<form method="post" class="f">
				<input class="f__close" type="button" id="btn-close-form-delete-pet" value="x">
				<h2 class="f__title">Confirmación</h2>
				<div class="line-top"></div>
				<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
				<div class="D-info">
					<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
				</div>
				<input class="submit" type="button" id="btn-C-delete-pet" value="Confirmar">
			</form>
		</div>
	<?php } ?>
	<div class="C__f oculto" id="form-add-pet">
		<form method="post" class="f">
			<input class="f__close" type="button" id="btn-close-form-add-pet" value="x">
			<h2 class="f__title">Nueva Mascota de <?=substr($cliente["cliente"], 0, 10)?></h2>
			<div class="line-top"></div>
			<div class="i__group">
				<label class="labels" for="pet-nombre-new">Nombre</label>
				<input class="inputs" type="text" id="pet-nombre-new" name="pet-nombre-new" required autofocus>
				<input type="hidden" name="pet-property-new" value="<?=$clienteId?>">
			</div>

			<div class="i__group">
				<label class="i-b w100 label-checkbox">Especie</label>
				<?php foreach ($mascotaEspecies as $key => $value) : ?>
					<input 
						type="radio" 
						name="pet-especie-new" 
						id="pet-<?=$value['especie']?>-new" 
						value="<?=$value['idmascota_especie']?>" 
						required>
					<label 
						class="label-radio" 
						for="pet-<?=$value['especie']?>-new">
						<?=$value['especie']?>
						</label>
				<?php endforeach ?>
			</div>

			<div class="i__group">
				<label class="label-checkbox" for="pet-raza-new">Raza</label>
				<select name="pet-raza-new" id="pet-raza-new" required>
					<option value="">Primero seleccione especie</option>
				</select>
			</div>
			
			<div class="i__group">
				<label class="i-b w100 label-checkbox">Sexo</label>
				<input type="radio" name="pet-sexo-new" id="pet-hembra-new" value="1" required>
				<label class="label-radio" for="pet-hembra-new">Hembra</label>
				<input type="radio" name="pet-sexo-new" id="pet-macho-new" value="2" required>
				<label class="label-radio" for="pet-macho-new">Macho</label>
			</div>

			<div class="i__group flex">
				<label class="labels" for="pet-anos-new">Edad (años)</label>
				<label class="labels left" for="pet-anos-new">Año de nacimiento</label>
				<input class="inputs" type="text" id="pet-anos-new" name="pet-anos-new" required>
				<span class="inputs disabled" id="span-edad-new"></span>
				<input type="hidden" id="pet-edad-new" name="pet-edad-new" required>
			</div>

			<div class="i__group">
				<label class="labels" for="pet-peso-new">Peso (Kg)</label>
				<input class="inputs" type="text" id="pet-peso-new" name="pet-peso-new" required>
			</div>

			<div class="i__group">
				<label class="i-b w100 label-checkbox">Tamaño</label>
				<input type="radio" name="pet-tamano-new" id="pet-chico-new" value="1" required>
				<label class="label-radio" for="pet-chico-new">Chico</label>
				<input type="radio" name="pet-tamano-new" id="pet-mediano-new" value="2" required>
				<label class="label-radio" for="pet-mediano-new">Mediano</label>
				<input type="radio" name="pet-tamano-new" id="pet-grande-new" value="3" required>
				<label class="label-radio" for="pet-grande-new">Grande</label>
			</div>
			
			<div class="i__group">
				<label class="label-checkbox" for="pet-cuerpo-new">Condición corporal</label>
				<select name="pet-cuerpo-new" id="pet-cuerpo-new" required>
					<option value="">Seleccione la condición corporal</option>
					<option value="1">Delgado</option>
					<option value="2">Normal</option>
					<option value="3">Robusto</option>
				</select>
			</div>

			<input class="submit" type="submit" value="Crear">
			<?php ControladorMascota::nuevaMascotaCtl(); ?>
		</form>
	</div>
</div>
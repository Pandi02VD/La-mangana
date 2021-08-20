<?php 
	$nameGET = 'um';
	$clienteId = $_GET[$nameGET];
	$cliente = ControladorCliente::seleccionarClienteCtl($clienteId);
	$mascotasCliente = ControladorMascota::mascotasClienteCtl($clienteId);
	$mascotaEspecies = ControladorMascota::seleccionarEspeciesCtl();
	$medicos = ControladorUsuario::medicosCtl();
?>
<div class="title">
	<h2>Mascotas</h2>
	<h3>Mascotas de <?= $cliente["cliente"] == null ? '<script>window.location = "index.php?pagina=Error";</script>' : $cliente["cliente"] ;?></h3>
</div>

<div class="C__Table">
	<?php if ($mascotasCliente == null) { ?>
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-pet">
			<span class="tooltip">Agregar mascota</span>
		</div>
		<div class="nodata"><span>Aún no hay registros</span></div>
	<?php }else{ ?>
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
				<input class="inputs" type="search" id="search-pet" name="search-pet" placeholder="Buscar Mascota">
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
					<span id="momento-consult-new">Registro: <?=date('d/m/Y - H:i:s');?></span>
					<input type="hidden" name="momento-consult-new" value="<?=date('d/m/Y - H:i:s');?>">
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

				<div class="i__group">
					<label class="i-b w100 label-checkbox" for="acs-consult-new">Accesorios con los que llega la mascota a la consulta.</label>
					<div class="D-info">
						<p class="info"><i>i</i> Separe con una coma (,) cada accesorio.</p>
					</div>
					<div style="position: relative">
						<input class="inputs" type="text" name="acs-consult-new" id="acs-consult-new">
					</div>
				</div>

				<div class="i__group">
					<label class="labels" for="costo-consult-new">Costo de Consulta ($ MNX)</label>
					<input class="inputs" type="text" id="costo-consult-new" name="costo-consult-new" required>
				</div>
				
				<input type="hidden" name="pet-id-add-consult" id="pet-id-add-consult" required>
				<input type="button" id="btn-MF" class="submit" value="Siguiente Paso">
			</form>
		</div>

		<div class="C__f oculto" id="form-add-H-pet">
			<form method="post" class="f">
				<!-- <a class="back" href="#" id="btn-return-to-MF"> Regresar</a> -->
				<input type="button" class="back" value="Regresar">
				<h2 class="f__title">Orden de Hospitalización</h2>
				<div class="line-top"></div>
				<div class="C__group">
					<h4>Programar Hospitalización</h4>
					<div class="line-top"></div>
					<div class="i__group m-no">
						<label class="label-checkbox" for="entrada-H-new">Ingreso</label>
						<input class="inputs" type="datetime-local" name="entrada-H-new" id="entrada-H-new">
					</div>
				</div>
				
				<div class="i__group">
					<label class="label-checkbox" for="jaula-H-new">Número de Jaula</label>
					<select name="jaula-H-new" id="jaula-H-new">
						<option value="">Seleccione la jaula</option>
						<option class="option-free" value="1">1 Libre</option>
						<option class="option-booked" value="2" disabled>2 Ocupado</option>
						<option class="option-free" value="2">3 Libre</option>
					</select>
				</div>
				
				<div class="i__group">
					<label class="i-b w100 label-checkbox" for="motivo-H-new">Motivo de Hospitalización</label>
					<input class="inputs" type="text" name="motivo-H-new" id="motivo-H-new">
				</div>
				
				<div class="i__group">
					<label class="i-b w100 label-checkbox" for="obs-H-new">Observaciones</label>
					<textarea class="" name="obs-H-new" id="obs-H-new"></textarea>
				</div>

				<div class="i__group">
					<label class="labels" for="costo-H-new">Costo de Hospitalización ($ MNX)</label>
					<input class="inputs" type="text" id="costo-H-new" name="costo-H-new">
				</div>
				
				<!-- <a href="#form-add-C-pet" id="btn-second" class="submit">Guardar orden</a> -->
				<input type="button" class="submit" value="Guardar Orden">
			</form>
		</div>

		<div class="C__f oculto" id="form-add-C-pet">
			<form method="post" class="f">
			<input type="button" class="back" value="Regresar">
				<!-- <a class="back" href="#form-add-H-pet" id="btn-return-to-second">Regresar</a> -->
				<h2 class="f__title">Anestesia y Cirujía</h2>
				<div class="line-top"></div>
				<div class="C__group">
					<h4>Programar Cirujía</h4>
					<div class="line-top"></div>
					<div class="i__group m-no">
						<label class="label-checkbox" for="pet-H-entrada">Entrada</label>
						<input class="inputs" type="datetime-local" name="pet-H-entrada" id="pet-H-entrada">
					</div>
				</div>

				<div class="i__group">
					<label class="i-b w100 label-checkbox" for="pet-H-motivo">Nombre de cirujía</label>
					<input class="inputs" type="text" name="pet-H-motivo" id="pet-H-motivo">
				</div>

				<div class="i__group">
					<label class="labels" for="pet-H-costo">Costo de Cirujía ($ MNX)</label>
					<input class="inputs" type="text" id="pet-H-costo" name="pet-H-costo">
				</div>
				
				<div class="i__group">
					<label class="label-checkbox" for="confirmar-C-new">El responsable del paciente ha leído el <a href="#" target="_blank">Consentimiento informado de Anestesia y Cirujía</a> y acepto lo expreso en dicho documento</label>
					<input class="d-none" type="checkbox" id="confirmar-C-new" name="confirmar-C-new">
				</div>
				
				<!-- <input class="submit" type="submit" value="Siguiente paso"> -->
				<input type="button" class="submit" value="Programar">
			</form>
		</div>

		<div class="C__f oculto" id="form-add-M-pet">
			<form method="post" class="f">
				<input type="button" class="back" value="Regresar">
				<!-- <a class="back" href="#form-add-H-pet" id="btn-return-to-first">Regresar</a> -->
				<h2 class="f__title">Medicación</h2>
				<div class="line-top"></div>
				
				<div class="i__group">
					<label class="labels" for="pet-H-motivo">Nombre del medicamento</label>
					<input class="inputs" type="text" name="pet-H-motivo" id="pet-H-motivo" autofocus>
				</div>
				
				<div class="i__group flex">
					<label class="labels" for="pet-H-motivo">Dosis</label>
					<label class="labels left" for="pet-H-motivo">Unidad</label>
					<input class="inputs" type="text" name="pet-H-motivo" id="pet-H-motivo">
					<select name="pet-H-jaula" id="pet-H-jaula">
						<option value="">Ampolleta</option>
						<option value="">Inyección</option>
						<option value="">Gotas</option>
						<option value="">Gramos</option>
						<option value="">Mililítro</option>
						<option value="">Píldora / Pastilla</option>
					</select>
				</div>

				<div class="i__group">
					<label class="labels" for="pet-H-motivo">Frecuencia</label>
					<input class="inputs" type="text" name="pet-H-motivo" id="pet-H-motivo">
				</div>

				<input class="submit" type="button" value="Agregar">

				<input type="button" class="submit" value="Siguiente Paso">
			</form>
		</div>

		<div class="C__f oculto" id="form-edit-pet">
			<form method="post" class="f">
				<input class="f__close" type="button" id="btn-close-form-edit-pet" value="x">
				<h2 class="f__title">Editar Mascota de <?=$cliente["cliente"]?></h2>
				<div class="line-top"></div>
				<div class="i__group">
					<label class="labels" for="pet-nombre-edit">Nombre</label>
					<input class="inputs" type="text" id="pet-nombre-edit" name="pet-nombre-edit">
				</div>

				<div class="i__group">
					<label class="i-b w100 label-checkbox">Especie</label>
					<label class="label-checkbox" for="pet-canino-edit">Canino</label>
					<input type="radio" name="pet-especie-edit" id="pet-canino-edit">
					<label class="label-checkbox" for="pet-felino-edit">Felino</label>
					<input type="radio" name="pet-especie-edit" id="pet-felino-edit">
				</div>

				<div class="i__group">
					<label class="label-checkbox" for="pet-raza-edit">Raza</label>
					<select name="pet-raza-edit" id="pet-raza-edit">
						<option value="">Seleccione la raza</option>
						<option value="1">Chachanete</option>
						<option value="2">Pastor Alemán</option>
					</select>
				</div>
				
				<div class="i__group">
					<label class="i-b w100 label-checkbox">Sexo</label>
					<label class="label-checkbox" for="pet-hembra-edit">Hembra</label>
					<input type="radio" name="pet-sexo-edit" id="pet-hembra-edit">
					<label class="label-checkbox" for="pet-macho">Macho</label>
					<input type="radio" name="pet-sexo-edit" id="pet-macho-edit">
				</div>

				<div class="i__group">
					<label class="labels" for="pet-edad-edit">Edad (años)</label>
					<input class="inputs" type="number" id="pet-edad-edit" name="pet-edad-edit">
				</div>
				
				<div class="i__group">
					<label class="label-checkbox" for="pet-cuerpo-edit">Condición corporal</label>
					<select name="pet-cuerpo-edit" id="pet-cuerpo-edit">
						<option value="">Seleccione la condición corporal</option>
						<option value="1">Delgado</option>
						<option value="2">Normal</option>
						<option value="2">Robusto</option>
					</select>
				</div>

				<div class="i__group">
					<label class="i-b w100 label-checkbox">Tamaño</label>
					<label class="label-checkbox" for="pet-chico-edit">Chico</label>
					<input type="radio" name="pet-tamano-edit" id="pet-chico-edit">
					<label class="label-checkbox" for="pet-mediano-edit">Mediano</label>
					<input type="radio" name="pet-tamano-edit" id="pet-mediano-edit">
					<label class="label-checkbox" for="pet-grande-edit">Grande</label>
					<input type="radio" name="pet-tamano-edit" id="pet-grande-edit">
				</div>

				<div class="i__group">
					<label class="labels" for="pet-color-edit">Color</label>
					<input class="inputs" type="color" id="pet-color-edit" name="pet-color-edit">
				</div>

				<div class="i__group">
					<label class="labels" for="pet-peso-edit">Peso (Kg)</label>
					<input class="inputs" type="number" id="pet-peso-edit" name="pet-peso-edit">
				</div>
				
				<input class="submit" type="submit" value="Crear">
				<input type="hidden" name="mascotaId-edit" id="mascotaId-edit">
				<?php 
					// $crearUsuario = ControladorUsuario::crearCuentaCtl();
				?>
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
				<input class="submit" type="submit" value="Confirmar">
				<?php 
					// $actualizaUsuario = ControladorUsuario::actualizarUsuarioCtl();
				?>
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
					<option value="2">Robusto</option>
				</select>
			</div>

			<input class="submit" type="submit" value="Crear">
			<?php ControladorMascota::nuevaMascotaCtl(); ?>
		</form>
	</div>
</div>
<h2>Mascotas de José Lameiras</h2>

<div class="C__Table">
	<h3>Historial clinico de Laica</h3>
	<!-- <div class="nodata"><span>Aún no hay registros</span></div> -->
	<div class="C__Btn">
		<input type="image" src="img/ambulance_32px.png" alt="imágen de acción" id="btn-add-H-pets">
		<span class="tooltip">Hospitalizar mascota</span>
	</div>
	<div class="C__Btn">
		<input type="image" src="img/syringe_32px.png" alt="imágen de acción" id="btn-add-E-pets">
		<span class="tooltip">Vacunar mascota</span>
	</div>
	<div class="C__Btn">
		<input type="image" src="img/broken_bone_32px.png" alt="imágen de acción" id="btn-add-HC-pets">
		<span class="tooltip">Cirujía</span>
	</div>
	<!-- </div> -->

	<table id="table">
		<tr>
			<th><input type="checkbox" name="check-all-petsd" id="check-all-petsd"></th>
			<th>Servicio</th>
			<th>Entrada</th>
			<th>Salida</th>
			<th>Estado</th>
		</tr>

		<tr style="background-color: lightgreen">
			<td><input type="checkbox" name="check-pet" id="check-pet" value=""></td>
			<td>Hospitalización</td>
			<td>12/02/2021 12:09 p. m.</td>
			<td>12/02/2021 12:22 p. m.</td>
			<td>Próximo</td>
		</tr>
		<tr style="background-color: var(--Form-Basic)">
			<td><input type="checkbox" name="check-pet" id="check-pet" value=""></td>
			<td>Cirujía</td>
			<td>12/02/2021 12:09 p. m.</td>
			<td>12/02/2021 12:22 p. m.</td>
			<td>En proceso</td>
		</tr>
		<tr style="background-color: indianred">
			<td><input type="checkbox" name="check-pet" id="check-pet" value=""></td>
			<td>Estética</td>
			<td>12/02/2021 12:09 p. m.</td>
			<td>12/02/2021 12:22 p. m.</td>
			<td>Concluido</td>
		</tr>
	</table>

	<!-- <div class="C__f oculto" id="form-add-pet">
		<button class="f__close" id="btn-close-form-add-pet">X</button>

		<form method="post" class="f">
		<h2 class="f__title">Nueva Mascota de <?=$cliente["nombre"]?></h2>
		<div class="line-top"></div>
		<div class="i__group">
			<label class="labels" for="pet-nombre-new">Nombre</label>
			<input class="inputs" type="text" id="pet-nombre-new" name="pet-nombre-new">
		</div>

		<div class="i__group">
			<label class="i-b w100 label-checkbox">Especie</label>
			<label class="label-checkbox" for="pet-canino-new">Canino</label>
			<input type="radio" name="pet-especie-new" id="pet-canino-new">
			<label class="label-checkbox" for="pet-felino-new">Felino</label>
			<input type="radio" name="pet-especie-new" id="pet-felino-new">
		</div>

		<div class="i__group">
			<label class="label-checkbox" for="pet-raza-new">Raza</label>
			<select name="pet-raza-new" id="pet-raza-new">
				<option value="">Seleccione la raza</option>
				<option value="1">Chachanete</option>
				<option value="2">Pastor Alemán</option>
			</select>
		</div>
		
		<div class="i__group">
			<label class="i-b w100 label-checkbox">Sexo</label>
			<label class="label-checkbox" for="pet-hembra-new">Hembra</label>
			<input type="radio" name="pet-sexo-new" id="pet-hembra-new">
			<label class="label-checkbox" for="pet-macho">Macho</label>
			<input type="radio" name="pet-sexo-new" id="pet-macho-new">
		</div>

		<div class="i__group">
			<label class="labels" for="pet-edad-new">Edad (años)</label>
			<input class="inputs" type="number" id="pet-edad-new" name="pet-edad-new">
		</div>
		
		<div class="i__group">
			<label class="label-checkbox" for="pet-cuerpo-new">Condición corporal</label>
			<select name="pet-cuerpo-new" id="pet-cuerpo-new">
				<option value="">Seleccione la condición corporal</option>
				<option value="1">Delgado</option>
				<option value="2">Normal</option>
				<option value="2">Robusto</option>
			</select>
		</div>

		<div class="i__group">
			<label class="i-b w100 label-checkbox">Tamaño</label>
			<label class="label-checkbox" for="pet-chico-new">Chico</label>
			<input type="radio" name="pet-tamano-new" id="pet-chico-new">
			<label class="label-checkbox" for="pet-mediano-new">Mediano</label>
			<input type="radio" name="pet-tamano-new" id="pet-mediano-new">
			<label class="label-checkbox" for="pet-grande-new">Grande</label>
			<input type="radio" name="pet-tamano-new" id="pet-grande-new">
		</div>

		<div class="i__group">
			<label class="labels" for="pet-color-new">Color</label>
			<input class="inputs" type="color" id="pet-color-new" name="pet-color-new">
		</div>

		<div class="i__group">
			<label class="labels" for="pet-peso-new">Peso (Kg)</label>
			<input class="inputs" type="number" id="pet-peso-new" name="pet-peso-new">
		</div>
		
		<input class="submit" type="submit" value="Crear">
		<?php 
			// $crearUsuario = ControladorUsuario::crearCuentaCtl();
		?>
		</form>

	</div>

	<div class="C__f oculto" id="form-edit-pet">
		<button class="f__close" id="btn-close-form-edit-pet">X</button>

		<form method="post" class="f">
		<h2 class="f__title">Editar Mascota de <?=$cliente["nombre"]?></h2>
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
		<button class="f__close" id="btn-close-form-delete-pet">X</button>
		<form method="post" class="f">
			<h2 class="f__title">Confirmación</h2>
			<div class="line-top"></div>
			<span class="label-checkbox">¿Desea eliminar el registro?</span>
			<div class="D-info">
				<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
			</div>
			<input class="submit" type="submit" value="Confirmar">
			<?php 
				// $actualizaUsuario = ControladorUsuario::actualizarUsuarioCtl();
			?>
		</form>
	</div>

	<div class="C__f oculto" id="form-add-H-pet">
		<button class="f__close" id="btn-close-form-add-H-pet">X</button>

		<form method="post" class="f">
		<h2 class="f__title">Orden de Hospitalización</h2>
		<div class="line-top"></div>
		<div class="tabs">
			<a href="#tab-consulta">Datos de consulta</a>
			<a href="#tab-mascota">Datos de la Mascota</a>
			<a href="#tab-propietario">Datos del dueño</a>
		</div>
		<div id="tabs-content">
			<div id="tab-consulta" class="ficha__info">
				<table id="table">
					<caption>Folio: #1234567</caption>
					<tr><td>Inicio: </td><td>12/02/2021 12:09 p. m.</td></tr>
					<tr><td>Fin: </td><td>12/02/2021 12:22 p. m.</td></tr>
					<tr><td>Observaciones: </td><td>Bla bla bla</td></tr>
				</table>
			</div>

			<div id="tab-mascota" class="ficha__info">
				<table id="table">
					<tr><td>Nombre: </td><td>Laica</td></tr>
					<tr><td>Raza: </td><td>Pastor Alemán</td></tr>
					<tr><td>Sexo: </td><td>Hembra</td></tr>
					<tr><td>Edad: </td><td>13 años</td></tr>
					<tr><td>Condición corporal: </td><td>Normal</td></tr>
					<tr><td>Tamaño: </td><td>Mediano</td></tr>
					<tr><td>Peso: </td><td>13.700 Kg.</td></tr>
				</table>
			</div>
			
			<div id="tab-propietario" class="ficha__info">
				<table id="table">
					<tr><td>Nombre: </td><td>José Lameiras</td></tr>
					<tr><td>Teléfono: </td><td>1112223344</td></tr>
					<tr><td>Domicilio: </td><td>Colonia Centro, Calle I. Allende</td></tr>
				</table>
			</div>
		</div>

		<div class="C__group">
			<h4>Programar Hospitalización</h4>
			<div class="line-top"></div>
			<div class="i__group m-no">
				<label class="label-checkbox" for="pet-H-entrada">Entrada</label>
				<input class="inputs" type="datetime-local" name="pet-H-entrada" id="pet-H-entrada">
			</div>
			<div class="i__group">
				<label class="label-checkbox" for="pet-H-salida">Salida</label>
				<input class="inputs" type="datetime-local" name="pet-H-salida" id="pet-H-salida">
			</div>
		</div>
		
		<div class="i__group">
			<label class="label-checkbox" for="pet-H-jaula">Número de Jaula</label>
			<select name="pet-H-jaula" id="pet-H-jaula">
				<option value="">Seleccione la jaula</option>
				<option class="option-free" value="1">1 Libre</option>
				<option class="option-booked" value="2" disabled>2 Ocupado</option>
				<option class="option-free" value="2">3 Libre</option>
			</select>
		</div>

		<div class="i__group">
			<label class="i-b w100 label-checkbox" for="pet-H-motivo">Motivo de Hospitalización</label>
			<input class="inputs" type="text" name="pet-H-motivo" id="pet-H-motivo">
		</div>

		<div class="i__group">
			<label class="labels" for="pet-H-costo">Costo ($ MNX)</label>
			<input class="inputs" type="number" id="pet-H-costo" name="pet-H-costo">
		</div>
		
		<input class="submit" type="submit" value="Guardar orden">
		<?php 
			// $crearUsuario = ControladorUsuario::crearCuentaCtl();
		?>
		</form>
	</div> -->
</div>
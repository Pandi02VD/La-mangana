<div class="title">
	<h2>Servicios</h2>
	<h3>Consulta</h3>
</div>

<?php if (isset($_GET["hospital"])) : ?>
<div class="C__F" id="form-add-H-pet">
	<form method="post" class="f">
		<!-- <input class="f__close" type="button" id="btn-close-form-add-Consult-pet" value="x"> -->
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
		<div>
			<input type="button" class="back" id="skip" value="Omitir">
		</div>
		<div>
			<input type="button" class="submit" value="Guardar Orden">
		</div>
	</form>
</div>
<?php endif ?>

<?php if (isset($_GET["surgery"])) : ?>
<div class="C__F" id="form-add-C-pet">
	<form method="post" class="f">
	<!-- <input class="f__close" type="button" id="btn-close-form-add-Consult-pet" value="x"> -->
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
		<div>
			<input type="button" class="back" id="skip" value="Omitir">
		</div>
		<div>
			<input type="button" class="submit" value="Programar">
		</div>
	</form>
</div>
<?php endif ?>

<?php if (isset($_GET["medical"])) : ?>
<div class="C__F" id="form-add-M-pet">
	<form method="post" class="f">
		<!-- <input class="f__close" type="button" id="btn-close-form-add-Consult-pet" value="x"> -->
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
		<div>
			<input type="button" class="back" id="skip" value="Omitir">
		</div>
		<div>
			<input type="button" class="submit" value="Siguiente Paso">
		</div>
	</form>
</div>
<?php endif ?>
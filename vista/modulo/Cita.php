<?php $config = ControladorUsuario::selConfigCtl(1); ?>
<div class="bgTop"></div>
<div class="bgBottom">
	<div>
		<h1 style="margin: 0">Agendar cita</h1>
		<form method="post" class="">
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="text" id="citaNombre-n" name="citaNombre-n" autofocus required>
					<label class="labels" for="citaNombre-n">Nombre</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="text" id="citaApellidos-n" name="citaApellidos-n" required>
					<label class="labels" for="citaApellidos-n">Apellidos</label>
				</div>
			</div>
			<div class="i__group">
				<input class="textfield" type="tel" name="citaTelefono-n" id="citaTelefono-n" required>
				<label class="labels" for="citaTelefono-n">Número de teléfono</label>
			</div>
			<div class="iflex">
				<div class="i__group">
					<input class="textfield" type="date" id="citaFecha-n" name="citaFecha-n" required>
					<label class="labels" for="citaFecha-n">Fecha</label>
				</div>
				<div class="i__group">
					<input class="textfield" type="time" id="citaHora-n" name="citaHora-n" required>
					<label class="labels" for="citaHora-n">hora</label>
				</div>
			</div>
			<div class="i__group" style="margin-top: 10px;">
			<?php if(!$config) : ?>
				<div class= "nodata"><span>Horario de Martes a Domingo de 10:00 a 18:30</span></div>
			<?php else : $configJSON = DataArrays::getFechaConfig(json_decode($config["configJSON"]));?>
				<div class= "nodata"><span>Horario <?=$configJSON?></span></div>
			<?php endif ?>
			</div>
			<div>
				<input class="submit" type="submit" value="Agendar">
				<?php ControladorExterno::agendarCitaCtl(); ?>
			</div>
		</form>
	</div>
</div>
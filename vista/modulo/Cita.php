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
			<div class="i__group">
				<input class="textfield" type="datetime-local" id="citaTiempo-n" name="citaTiempo-n" required>
				<label class="labels" for="citaTiempo-n">Fecha y hora</label>
			</div>
			<div>
				<input class="submit" type="submit" value="Agendar">
				<?php ControladorExterno::agendarCitaCtl(); ?>
			</div>
		</form>
	</div>
</div>
<?php 
	$servicioId;
	if (isset($_GET["us"])) {
		if (empty($_GET["us"])) {
			echo '<script>window.location = "index.php?pagina=Servicios&error=true"</script>';
		} else {
			$servicioId = $_GET["us"];
			$servicioNombre = "medicina";
			ControladorServicios::validarServicioCtl($servicioId, $servicioNombre);
		}
	} else {
		echo '<script>window.location = "index.php?pagina=Servicios&error=true"</script>';
	}

	$consulta = ControladorServicios::obtenerConsultaCtl($servicioId);
	$siguiente = "pagina=Servicios";
?>
<div class="title">
	<h2>Servicios</h2>
	<h3>Medicamento</h3>
	<div class="Cards__main">
		<div>
			<span style="width: calc(50% - 20px)">Paciente: <?=$consulta["mascota"]?></span>
			<span style="width: calc(50% - 20px)">Médico: <?=$consulta["medico"]?></span>
		</div>
	</div>
</div>

<div class="C__F" id="form-add-M-pet">
	<form method="post" class="f">
		<!-- <input class="f__close" type="button" id="btn-close-form-add-Consult-pet" value="x"> -->
		<h2 class="f__title">Medicamento</h2>
		<div class="line-top"></div>
		
		<div class="i__group">
			<label class="labels" for="pet-H-motivo">Nombre del medicamento</label>
			<input class="inputs" type="text" name="pet-H-motivo" id="pet-H-motivo" autofocus>
			<input type="hidden" name="next-service-new" id="next-service-new" value="<?=$siguiente?>">
			<input type="hidden" name="consultaId-new" id="consultaId-new" value="<?=$servicioId?>">
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
		<!-- <div>
			<input type="button" class="back" id="skip" value="Omitir">
		</div> -->
		<div>
			<input type="button" class="submit" value="Siguiente Paso">
		</div>
	</form>
</div>
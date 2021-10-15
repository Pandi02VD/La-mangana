<?php 
	$servicioId;
	if (isset($_GET["us"])) {
		if (empty($_GET["us"])) {
			echo '<script>window.location = "index.php?pagina=Servicios&error=true"</script>';
		} else {
			$servicioId = $_GET["us"];
			$servicioNombre = "cirugia";
			ControladorServicios::validarServicioCtl($servicioId, $servicioNombre);
		}
	} else {
		echo '<script>window.location = "index.php?pagina=Servicios&error=true"</script>';
	}

	$consulta = ControladorServicios::obtenerConsultaCtl($servicioId);
	$siguiente = json_decode($consulta["servicios"]);
	if (isset($siguiente->medicina)) {
		$siguiente = "pagina=Medicina";
	} else {
		$siguiente = "pagina=Servicios";
	}
?>

<div class="title">
	<h2>Servicios</h2>
	<h3>Cirugía</h3>
	<div class="Cards__main">
		<div>
			<span style="width: calc(50% - 20px)">Paciente: <?=$consulta["mascota"]?></span>
			<span style="width: calc(50% - 20px)">Médico: <?=$consulta["medico"]?></span>
		</div>
	</div>
</div>

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
				<input type="hidden" name="next-service-new" id="next-service-new" value="<?=$siguiente?>">
				<input type="hidden" name="consultaId-new" id="consultaId-new" value="<?=$servicioId?>">
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
		<!-- <div>
			<input type="button" class="back" id="skip" value="Omitir">
		</div> -->
		<div>
			<input type="button" class="submit" value="Programar">
		</div>
	</form>
</div>
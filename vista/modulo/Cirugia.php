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

	$consulta = ControladorServicios::personasConsultaCtl($servicioId);
	$siguiente = json_decode($consulta["servicios"]);
	if (isset($siguiente->medicina)) {
		if(ControladorServicios::servicioPendienteCtl("medicina", $servicioId) != null) {
			$siguiente = "pagina=Servicios" ;
		} else {
			$siguiente = "pagina=Medicina&us=".$servicioId;
		}
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
				<label class="label-checkbox" for="entrada-C-new">Entrada</label>
				<input class="inputs" type="datetime-local" name="entrada-C-new" id="entrada-C-new" required>
				<input type="hidden" name="next-service-new" id="next-service-new" value="<?=$siguiente?>">
				<input type="hidden" name="consultaId-new" id="consultaId-new" value="<?=$servicioId?>">
			</div>
		</div>

		<div class="i__group">
			<label class="i-b w100 label-checkbox" for="nombre-C-new">Nombre de cirujía</label>
			<input class="inputs" type="text" name="nombre-C-new" id="nombre-C-new" required>
		</div>

		<div class="i__group">
			<label class="i-b w100 label-checkbox" for="obs-C-new">Observaciones (opcional)</label>
			<textarea class="" name="obs-C-new" id="obs-C-new"></textarea>
		</div>

		<div class="i__group">
			<label class="labels" for="costo-C-new">Costo de Cirujía ($ MNX)</label>
			<input class="inputs" type="text" id="costo-C-new" name="costo-C-new" required>
		</div>
		
		<div class="i__group">
			<label class="label-checkbox" for="confirmar-C-new">El responsable del paciente ha leído el <a href="#" target="_blank">Consentimiento informado de Anestesia y Cirujía</a> y acepto lo expreso en dicho documento</label>
			<input class="d-none" type="checkbox" id="confirmar-C-new" name="confirmar-C-new" required>
		</div>

		<div>
			<input type="submit" class="submit" value="Programar">
			<?php ControladorServicios::nuevaCirugiaCtl(); ?>
		</div>
	</form>
</div>
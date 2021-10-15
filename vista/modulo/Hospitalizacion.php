<?php 
	$servicioId;
	if (isset($_GET["us"])) {
		if (empty($_GET["us"])) {
			echo '<script>window.location = "index.php?pagina=Servicios&error=true"</script>';
		} else {
			$servicioId = $_GET["us"];
			$servicioNombre = "hospital";
			ControladorServicios::validarServicioCtl($servicioId, $servicioNombre);
		}
	} else {
		echo '<script>window.location = "index.php?pagina=Servicios&error=true"</script>';
	}

	$consulta = ControladorServicios::obtenerConsultaCtl($servicioId);
	$siguiente = json_decode($consulta["servicios"]);
	if (isset($siguiente->cirugia)) {
		$siguiente = "pagina=Cirugia";
	} else if (isset($siguiente->medicina)) {
		$siguiente = "pagina=Medicina";
	} else {
		$siguiente = "pagina=Servicios";
	}
	$jaulas = ControladorMascota::seleccionarJaulasCtl();
?>

<div class="title">
	<h2>Servicios</h2>
	<h3>Hospitalización</h3>
	<div class="Cards__main">
		<div>
			<span style="width: calc(50% - 20px)">Paciente: <?=$consulta["mascota"]?></span>
			<span style="width: calc(50% - 20px)">Médico: <?=$consulta["medico"]?></span>
		</div>
	</div>
</div>

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
				<input class="inputs" type="datetime-local" name="entrada-H-new" id="entrada-H-new" required>
				<input type="hidden" name="next-service-new" id="next-service-new" value="<?=$siguiente?>">
				<input type="hidden" name="consultaId-new" id="consultaId-new" value="<?=$servicioId?>">
			</div>
		</div>
		
		<div class="i__group">
			<label class="label-checkbox" for="jaula-H-new">Número de Jaula</label>
			<select name="jaula-H-new" id="jaula-H-new" required>
				<option value="">Seleccione la jaula</option>
				<?php 
					foreach ($jaulas as $key => $value) : 
						if ($value["status"] == 1) {
				?>
					<option 
						class="option-free" 
						value="<?=$value["jaula"]?>"><?=$value["jaula"]?> <?="disponible"?>
					</option>
				<?php
						} elseif ($value["status"] == 2) {
				?>
					<option 
						class="option-booked" 
						value="<?=$value["jaula"]?>" disabled><?=$value["jaula"]?> <?="ocupado"?>
					</option>
				<?php
						}
				?>
				<?php endforeach ?>
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
			<input class="inputs" type="text" id="costo-H-new" name="costo-H-new" required>
		</div>
		<div>
			<input type="submit" class="submit" value="Guardar Orden">
			<?php ControladorServicios::nuevaHospitalizacionCtl(); ?>
		</div>
	</form>
</div>
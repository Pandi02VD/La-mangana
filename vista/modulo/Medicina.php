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

	$consulta = ControladorServicios::personasConsultaCtl($servicioId);
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
		<h2 class="f__title">Medicamento</h2>
		<div class="line-top"></div>
		
		<div>
			<div class="i__group">
				<label class="labels" for="nombre-M-new">Nombre del medicamento</label>
				<input class="inputs" type="text" name="nombre-M-new" id="nombre-M-new" autofocus>
				<input type="hidden" name="consultaId-new" id="consultaId-new" value="<?=$servicioId?>">
			</div>
			
			<div class="i__group flex">
				<label class="labels" for="dosis-M-new">Dosis</label>
				<label class="labels left" for="unidad-M-new">Unidad</label>
				<input class="inputs" type="text" name="dosis-M-new" id="dosis-M-new">
				<select name="unidad-M-new" id="unidad-M-new">
					<option value="">Ampolleta</option>
					<option value="">Inyección</option>
					<option value="">Gotas</option>
					<option value="">Gramos</option>
					<option value="">Mililítro</option>
					<option value="">Píldora / Pastilla</option>
				</select>
			</div>
			
			<div class="i__group">
				<label class="labels" for="frecuencia-M-new">Frecuencia</label>
				<input class="inputs" type="text" name="frecuencia-M-new" id="frecuencia-M-new">
			</div>
			<input name="add-M-new" id="add-M-new" class="submit" type="button" value="Agregar">
		</div>
		<div class="C__group">
			<ul id="list"></ul>
		</div>
		<template id="medic-template">
			<li>
				<span name="nombre">Nombre</span>
				<div class="C__Btn__Last">
					<img name="drop" src="img/trash_32px.png" alt="Quitar">
				</div>
				<input type="hidden" name="medical-M-new[]">
			</li>
		</template>
		<div>
			<input type="submit" class="submit" value="Finalizar">
			<?php ControladorServicios::nuevaMedicacionCtl(); ?>
		</div>
	</form>
</div>
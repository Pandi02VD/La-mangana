<?php
	$hospitalId = $_GET["us"];
	$hospital = ControladorServicios::obtenerHospitalizacionCtl($hospitalId);
	$jaula = ControladorMascota::seleccionarJaulaCtl($hospital["idjaula"]);
	$consulta = ControladorServicios::obtenerConsultaCtl($hospital["idconsulta"]);
	$personas = ControladorServicios::personasConsultaCtl($hospital["idconsulta"]);
	$mascota = ControladorMascota::infoMascotaCtl($personas["idmascota"]);
	$salida = null;
	$hospital["salida"] == null ? $salida = "Pendiente" : $salida = $hospital["salida"];
	// print_r($jaula);
?>

<div class="title">
	<h2>Servicios</h2>
	<h3>Hospitalización</h3>
</div>	
<div class="C__F">
	<div class="Cards w70">
		<div class="Cards__Contentinfo">
			<div class="Cards__logo services">
				<img src="img/clinic_50px.png" alt="Broken Bone">
			</div>
			<div class="Cards__info services">
				<h3 id="Cards-user-name"><?=substr($personas["mascota"], 0, 25)?></h3>
			</div>
		</div>

		<div class="C__Btn">
			<input type="image" src="img/heart_health_32px.png" alt="imágen de acción"  id="btn-high-hospital">
			<span class="tooltip">Alta de Hospitalización</span>
		</div>

		<div class="Cards__main">
			<h4 class="services">Datos de Hospitalización</h4>
			<div>
				<span>Hospitalizado en:</span>
				<span>Jaula <?=$jaula["jaula"]?></span>
			</div>
			<div>
				<span>Médico:</span>
				<span><?=$personas["medico"]?></span>
			</div>
			<div>
				<span>Motivo de Hospitalización:</span>
				<span><?=$hospital["motivo"]?></span>
			</div>
			<div>
				<span>Entrada:</span>
				<span><?=$hospital["entrada"]?></span>
			</div>
			<div>
				<span>Salida:</span>
				<span><?=$salida?></span>
			</div>
			<div>
				<span>Observaciones:</span>
				<span><?=$consulta["observaciones"]?></span>
			</div>
			<div>
				<span>Costo Consulta:</span>
				<span>$<?=$consulta["costo"]?></span>
			</div>
			<div>
				<span>Costo Hospitalización:</span>
				<span>$<?=$hospital["costo"]?></span>
			</div>
			<div>
				<span>Total:</span>
				<span>$<?=$consulta["costo"] + $hospital["costo"]?></span>
			</div>
		</div>
		
		<div class="Cards__main">
			<h4 class="services">Información del paciente</h4>
			<div>
				<span>Nombre del paciente:</span>
				<span><?=$personas["mascota"]?></span>
			</div>
			<div>
				<span>Edad:</span>
				<span><?=date("Y") - $mascota["ano_nacimiento"]?> años</span>
			</div>
			<div>
				<span>Especie:</span>
				<span><?=$mascota["especie"]?></span>
			</div>
			<div>
				<span>Raza:</span>
				<span><?=$mascota["raza"]?></span>
			</div>
		</div>
	</div>
</div>

<div class="C__f oculto" id="form-high-hospital">
	<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-high-hospital" value="x">
		<h2 class="f__title">Alta de Hospitalización</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<label class="labels" for="tiempoAlta-hos">Fecha y Hora</label>
			<input class="inputs" type="datetime-local" id="tiempoAlta-hos" name="tiempoAlta-hos" required>
		</div>
		<input type="hidden" name="hospitalId" id="hospitalId" value="<?=$hospitalId?>" required>
		<input type="hidden" name="jaulaId" id="jaulaId" value="<?=$jaula["idjaula"]?>" required>
		<input class="submit" type="submit" id="btn-C-high-hospital" value="Confirmar">
		<?php ControladorServicios::altaHospitalCtl(); ?>
	</form>
</div>
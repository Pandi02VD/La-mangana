<?php
	$hospitalId = $_GET["us"];
	$hospital = ControladorServicios::obtenerHospitalizacionCtl($hospitalId);
	$jaula = ControladorMascota::seleccionarJaulaCtl($hospital["idjaula"]);
	$consulta = ControladorServicios::obtenerConsultaCtl($hospital["idconsulta"]);
	$personas = ControladorServicios::personasConsultaCtl($hospital["idconsulta"]);
	$mascota = ControladorMascota::infoMascotaCtl($personas["idmascota"]);
	$salida = null;
	$salida == null ? $salida = "Pendiente" : $salida = $salida;
	// print_r($personas);
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

		<div class="Cards__main">
			<!-- <div class="C__Btn">
				<input type="image" src="img/heart_health_32px.png" alt="imágen de acción" id="btn-delete-service">
				<span class="tooltip">Alta de servicio</span>
			</div> -->
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
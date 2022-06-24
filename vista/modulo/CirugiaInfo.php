<?php
	$cirugiaId = $_GET["us"];
	$cirugia = ControladorServicios::obtenerCirugiaCtl($cirugiaId);
	$consulta = ControladorServicios::obtenerConsultaCtl($cirugia["idconsulta"]);
	$personas = ControladorServicios::personasConsultaCtl($cirugia["idconsulta"]);
	$mascota = ControladorMascota::infoMascotaCtl($personas["idmascota"]);
	$salida = null;
	$salida == null ? $salida = "Pendiente" : $salida = $salida;
	// print_r($cirugia);
?>

<div class="title">
	<h2>Servicios</h2>
	<h3>Cirugía</h3>
</div>	
<div class="C__F">
	<div class="Cards w70">
		<div class="Cards__Contentinfo">
			<div class="Cards__logo services">
				<img src="img/broken_bone_50px.png" alt="Broken Bone">
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
			<h4 class="services">Datos de Cirugía</h4>
			<div>
				<span>Médico:</span>
				<span><?=$personas["medico"]?></span>
			</div>
			<div>
				<span>Entrada:</span>
				<span><?=$cirugia["entrada"]?></span>
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
				<span>Costo Cirugía:</span>
				<span>$<?=$cirugia["costo"]?></span>
			</div>
			<div>
				<span>Total:</span>
				<span>$<?=$consulta["costo"] + $cirugia["costo"]?></span>
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
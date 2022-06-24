<?php 
	$nameGET = 'um';
	$mascotaId = $_GET[$nameGET];
	$mascota = ControladorMascota::seleccionarMascotaCtl($mascotaId);
	$clienteId = $mascota["iduser"];
	$clienteCorreos = Controlador::seleccionarCorreosCtl($clienteId);
	$clienteTelefonos = Controlador::seleccionarTelefonosCtl($clienteId);
	$clienteDomicilios = Controlador::seleccionarDomiciliosCtl($clienteId);
	$servicios = ControladorServicios::seleccionarServiciosMascotaCtl($mascotaId);

	$correoPrincipal = MainInfo::obtenerCorreoPrincipal($clienteCorreos);
	$telefonoPrincipal = MainInfo::obtenerTelefonoPrincipal($clienteTelefonos);
	$domicilioPrincipal = MainInfo::obtenerDomicilioPrincipal($clienteDomicilios);
	// print_r($servicios);
?>
<div class="title">
	<h2>Mascota</h2>
	<h3><?=$mascota["mascota"]?></h3>
</div>

<div class="C__F" id="form-card-client">
	<div class="Cards w70">
		<div class="Cards__Contentinfo">
			<div class="Cards__logo">
				<img src="img/pets_50px.png" alt="Pets">
			</div>
			<div class="Cards__info">
				<h3 id="Cards-user-name"><?=substr($mascota["mascota"], 0, 25)?></h3>
			</div>
		</div>
		
		<div class="Cards__main">
			<?php
				$raza = ControladorMascota::seleccionarRazaMascotaCtl($mascota["idmascota_raza"])["raza"];
				$edad = date("Y") - $mascota["ano_nacimiento"];
				
				switch($mascota["sexo"]){
					case 1: $sexo = "Hembra"; break;
					case 2: $sexo = "Macho"; break;
				}
			?>
			<h4>Datos de la mascota</h4>
			<div>
				<span>Edad:</span>
				<span><?= $edad ?></span>
			</div>
			<div>
				<span>Sexo:</span>
				<span><?= $sexo ?></span>
			</div>
			<div>
				<span>Raza:</span>
				<span><?= $raza ?></span>
			</div>
			<div>
				<span>Atributos:</span>
				<span>
					<div>
						<input type="hidden" name="mascotaId" id="mascotaId" value="<?=$mascotaId?>">
						<div style="height: 200px" id="graficaPeso"></div>
						<div style="height: 200px" id="graficaCuerpo"></div>
					</div>
				</span>
			</div>
		</div>

		<div class="Cards__main">
			<h4>Historial Clínico</h4>
			<div class="C__Table">
				<table class="table" id="tbl-servicios">
					<tr>
						<th>Médico</th>
						<th>Mótivo</th>
						<th>Consulta</th>
						<th>Fecha</th>
					</tr>
						<?php 
							foreach($servicios as $key => $value) :
						?>
						
					<tr>
						<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["medico"]?></td>
						<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["motivo"]?></td>
						<td id="<?=$value["consulta"]?>" name="services-table">$<?=$value["costo"]?></td>
						<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["fecha"]?></td>
					</tr>
						<?php endforeach; ?>
				</table>
			</div>
			<div>
				<span><a class="buttonSmall" href="index.php?pagina=HistoriaClinica&um=<?=$mascotaId?>">Ver Historial completo</a></span>
			</div>
		</div>
		
		<div class="Cards__main">
			<h4>Datos del dueño</h4>
			<div>
				<span>Nombre:</span>
				<span><?= $mascota["nombre"] ?></span>
			</div>
			<div>
				<span>Correo electrónico:</span>
				<span><?= $correoPrincipal ?></span>
			</div>
			<div>
				<span>Teléfono:</span>
				<span><?= $telefonoPrincipal ?></span>
			</div>
			<div>
				<span>Domicilio:</span>
				<span><?= $domicilioPrincipal ?></span>
			</div>
		</div>
	</div>
</div>
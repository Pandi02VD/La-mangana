<?php 
	$nameGET = 'um';
	$mascotaId = $_GET[$nameGET];
	$mascota = ControladorMascota::seleccionarMascotaCtl($mascotaId);
	// $historia = ControladorServicios::seleccionarServiciosMascotaCtl($mascotaId);
	// print_r($historia);

	$arrayHistoria = ControladorServicios::seleccionarHistoriaClinicaCtl($mascotaId);
	$size = 3;
	$init = 0;
	$inicio = 0;
	$modulo = '';
	if(isset($_GET["pag"])){
		$init = $_GET["pag"];
	}
	if(isset($_GET["pagina"])){
		$modulo = $_GET["pagina"];
	}

	$paginacion = Paginacion::pnt($modulo, sizeof($arrayHistoria), $init, $size);
	$paginacion != null ? $inicio = $paginacion['inicio'] : null ;
	$historia = array_slice($arrayHistoria, $inicio, $size);
	// print_r($mascota);
?>

<div class="title">
	<h2>Historia Clínica</h2>
	<h3><?=$mascota["mascota"]." - ".$mascota["nombre"]?></p></h3>
</div>

<div class="C__Table historia">
	<?php if($paginacion != null) : ?>
		<div class="Pnt">
			<a <?=$paginacion['onPrev']?> href="<?=$paginacion['hrefPrev']?>">&#60</a>
			<?php for($i = 1; $i <= $paginacion['pags']; $i++) : ?>
				<a 
					class="<?=$i == $init ? 'active' : ''?>"
					href="index.php?pagina=<?=$modulo?>&pag=<?=$i?>"><?=$i?></a>
			<?php endfor ?>
			<a <?=$paginacion['onNext']?> href="<?=$paginacion['hrefNext']?>">&#62</a>
		</div>
	<?php endif; ?>

	
	<div class="Section">
		<h3 class="subTitle">Historial Médico</h3>
		<div>
			<div class="C__Btn">
				<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-service">
				<span class="tooltip">Agregar consulta</span>
			</div>
			<div class="C__Btn">
				<input type="image" src="img/edit_32px.png" alt="imágen de acción"  id="btn-edit-service" disabled>
				<span class="tooltip">Editar consulta</span>
			</div>
			<div class="C__Btn">
				<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-service" disabled>
				<span class="tooltip">Eliminar consulta</span>
			</div>
			<div class="C__Btn__Last">
				<input class="inputs box" type="text" id="search-service" name="search-service" placeholder="Buscar">
				<span class="iconSearch"><image src="img/search_20px.png"></image></span>
			</div>
		</div>
		<table class="table" id="tbl-servicios">
			<tr>
				<th>
					<input type="checkbox" name="check-all-services" id="check-all-services">
					<span class="tooltip">Seleccionar todo</span>
				</th>
				<th>Médico</th>
				<th>Mótivo</th>
				<th>Costo de Consulta</th>
				<th>Fecha</th>
				<th>Servicios</th>
			</tr>
				<?php 
					foreach($historia as $key => $value) :
						$JSONServicios = json_decode($value["servicios"]);
						$hospital = ControladorServicios::hospitalAElementCtl($JSONServicios, $value["consulta"]);
						$cirugia = ControladorServicios::cirugiaAElementCtl($JSONServicios, $value["consulta"]);
						$medicina = ControladorServicios::medicinaAElementCtl($JSONServicios, $value["consulta"]);
				?>
				
			<tr>
				<td>
					<input type="checkbox" name="check-service" id="check-service<?=$value["consulta"]?>" value="<?=$value["consulta"]?>">
					<span class="tooltip">Seleccionar</span>
				</td>
				<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["medico"]?></td>
				<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["motivo"]?></td>
				<td id="<?=$value["consulta"]?>" name="services-table">$<?=$value["costo"]?></td>
				<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["fecha"]?></td>
				<td id="<?=$value["consulta"]?>" name="services-table">
					<a 
						class="clip <?=$hospital["status"]?> <?=$hospital["on"]?>" 
						href="<?=$hospital["href"]?>">Hospital <?= $hospital["jaula"] !== '' ? " en jaula ".$hospital["jaula"] : '' ?>
					</a>
					<a 
						class="clip <?=$cirugia["status"]?> <?=$cirugia["on"]?>" 
						href="<?=$cirugia["href"]?>">Cirugía</a>
					<a 
						class="clip <?=$medicina["status"]?> <?=$medicina["on"]?>" 
						href="<?=$medicina["href"]?>">Medicamento
					</a>
				</td>
			</tr>
				<?php endforeach ?>
		</table>
	</div>

	<div class="Section">
		<h3 class="subTitle">Seguimiento corporal</h3>
		<div>
			<input type="hidden" name="mascotaId" id="mascotaId" value="<?=$mascotaId?>">
			<div style="height: 200px" id="graficaPeso"></div>
			<div style="height: 200px" id="graficaCuerpo"></div>
		</div>
	</div>
</div>
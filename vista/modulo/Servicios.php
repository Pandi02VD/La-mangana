<?php 
	$arrayServicios = ControladorServicios::seleccionarServiciosCtl();
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

	$paginacion = Paginacion::pnt($modulo, sizeof($arrayServicios), $init, $size);
	$paginacion != null ? $inicio = $paginacion['inicio'] : null ;
	$servicios = array_slice($arrayServicios, $inicio, $size);
?>

<div class="title">
	<h2>Servicios</h2>
</div>

<div class="C__Table">
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
	<?php endif ?>
	<div>
		<div class="C__Btn">
			<input type="image" src="img/add_32px.png" alt="imágen de acción" id="btn-add-service">
			<span class="tooltip">Agregar servicio</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/edit_32px.png" alt="imágen de acción"  id="btn-edit-service" disabled>
			<span class="tooltip">Editar servicio</span>
		</div>
		<div class="C__Btn">
			<input type="image" src="img/trash_32px.png" alt="imágen de acción" id="btn-delete-service" disabled>
			<span class="tooltip">Eliminar servicio</span>
		</div>
		<div class="C__Btn__Last">
			<input class="inputs box" type="text" id="search-service" name="search-service" placeholder="Buscar">
			<span class="iconSearch"><image src="img/search_20px.png"></image></span>
		</div>
	</div>

	<div class="D-info">
		<p class="info">Haga clic en un servicio para ver más información 
			<button class="tag__close" name="btn-close-info">x</button>
		</p>
	</div>

	<table class="table" id="tbl-servicios">
		<tr>
			<th>
				<input type="checkbox" name="check-all-services" id="check-all-services">
				<span class="tooltip">Seleccionar todo</span>
			</th>
			<th>Mascota</th>
			<th>Médico</th>
			<th>Mótivo</th>
			<th>Consulta</th>
			<th>Fecha</th>
			<th>Servicios</th>
		</tr>
			<?php 
				foreach($servicios as $key => $value) :
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
			<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["mascota"]?></td>
			<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["medico"]?></td>
			<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["motivo"]?></td>
			<td id="<?=$value["consulta"]?>" name="services-table">$<?=$value["costo"]?></td>
			<td id="<?=$value["consulta"]?>" name="services-table"><?=$value["fecha"]?></td>
			<td id="<?=$value["consulta"]?>" name="services-table">
				<a 
					class="clip <?=$hospital["status"]?> <?=$hospital["on"]?>" 
					href="<?=$hospital["href"]?>">Hospital</a>
				<a 
					class="clip <?=$cirugia["status"]?> <?=$cirugia["on"]?>" 
					href="<?=$cirugia["href"]?>">Cirugía</a>
				<a 
					class="clip <?=$medicina["status"]?> <?=$medicina["on"]?>" 
					href="<?=$medicina["href"]?>">Medicamento</a>
			</td>
		</tr>
			<?php endforeach ?>
	</table>
</div>
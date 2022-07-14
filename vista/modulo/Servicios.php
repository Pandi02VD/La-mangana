<?php 
	$arrayServicios = ControladorServicios::seleccionarServiciosCtl();
	$size = 4;
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
	<!-- <div>
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
	</div> -->

	<!-- <div class="D-info">
		<p class="info">Haga clic en un servicio para ver más información 
			<button class="tag__close" name="btn-close-info">x</button>
		</p>
	</div> -->

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

	<div class="C__f oculto" id="form-add-service">
		<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-add-service" value="x">
		<h2 class="f__title">Nueva consulta</h2>
		<div class="line-top"></div>
		<!-- <div class="i__group">
			<label class="label-checkbox" for="tipo-usuario-new">Tipo de usuario</label>
			<select name="tipo-usuario-new" id="tipo-usuario-new" required>
				<option value="">Seleccione el tipo de usuario</option>
				<option value="2">Asistente</option>
				<option value="3">Médico</option>
			</select>
		</div>
			
		<div class="i__group">
			<label class="labels" for="nombre-new">Nombre</label>
			<input class="inputs" type="text" id="nombre-new" name="nombre-new" required>
		</div>

		<div class="i__group">
			<label class="labels" for="usuario-new">Usuario</label>
			<input class="inputs" type="text" id="usuario-new" name="usuario-new" required>
		</div>
			
		<div class="i__group">
			<label class="labels" for="contrasena-new">Contraseña</label>
			<input class="inputs" type="password" id="contrasena-new" name="contrasena-new" required>
		</div> -->
		
		<input class="submit" type="submit" value="Crear">
		<?php 
			// $crearUsuario = ControladorUsuario::crearCuentaCtl();
		?>
		</form>
	</div>
	
	<div class="C__f oculto" id="form-edit-service">
		<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-edit-service" value="x">
		<h2 class="f__title">Editar consulta</h2>
		<div class="line-top"></div>
		<!-- <div class="i__group">
			<label class="label-checkbox" for="tipo-usuario-new">Tipo de usuario</label>
			<select name="tipo-usuario-new" id="tipo-usuario-new" required>
				<option value="">Seleccione el tipo de usuario</option>
				<option value="2">Asistente</option>
				<option value="3">Médico</option>
			</select>
		</div>
			
		<div class="i__group">
			<label class="labels" for="nombre-new">Nombre</label>
			<input class="inputs" type="text" id="nombre-new" name="nombre-new" required>
		</div>

		<div class="i__group">
			<label class="labels" for="usuario-new">Usuario</label>
			<input class="inputs" type="text" id="usuario-new" name="usuario-new" required>
		</div>
			
		<div class="i__group">
			<label class="labels" for="contrasena-new">Contraseña</label>
			<input class="inputs" type="password" id="contrasena-new" name="contrasena-new" required>
		</div> -->
		
		<input class="submit" type="submit" value="Crear">
		<?php 
			// $crearUsuario = ControladorUsuario::crearCuentaCtl();
		?>
		</form>
	</div>
	
	<div class="C__f oculto" id="form-delete-service">
		<form method="post" class="f">
		<input class="f__close" type="button" id="btn-close-form-delete-service" value="x">
		<h2 class="f__title">Eliminar consulta</h2>
		<div class="line-top"></div>
		<!-- <div class="i__group">
			<label class="label-checkbox" for="tipo-usuario-new">Tipo de usuario</label>
			<select name="tipo-usuario-new" id="tipo-usuario-new" required>
				<option value="">Seleccione el tipo de usuario</option>
				<option value="2">Asistente</option>
				<option value="3">Médico</option>
			</select>
		</div>
			
		<div class="i__group">
			<label class="labels" for="nombre-new">Nombre</label>
			<input class="inputs" type="text" id="nombre-new" name="nombre-new" required>
		</div>

		<div class="i__group">
			<label class="labels" for="usuario-new">Usuario</label>
			<input class="inputs" type="text" id="usuario-new" name="usuario-new" required>
		</div>
			
		<div class="i__group">
			<label class="labels" for="contrasena-new">Contraseña</label>
			<input class="inputs" type="password" id="contrasena-new" name="contrasena-new" required>
		</div> -->
		
		<input class="submit" type="submit" value="Crear">
		<?php 
			// $crearUsuario = ControladorUsuario::crearCuentaCtl();
		?>
		</form>
	</div>
</div>
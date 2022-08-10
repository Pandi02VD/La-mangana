<?php 
	$arrayServicios = ControladorServicios::seleccionarServiciosCtl();
	$medicos = ControladorUsuario::medicosCtl();
	$mascotas = ControladorMascota::listarMascotasCtl();
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
	// print_r($servicios);
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
			<span class="tooltip">Agregar consulta</span>
		</div>
		<div class="C__Btn">
			<input type="hidden" src="img/edit_32px.png" alt="imágen de acción" id="btn-edit-service">
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
			<h2 class="f__title">Registro de consulta</h2>
			<div class="line-top"></div>
			<div class="f__datetime">
				<span>Registro: <?=date('d/m/Y - H:i:s');?></span>
				<input type="hidden" id="momento-consult-new" name="momento-consult-new" value="<?=date('Y-m-d H:i:s');?>">
			</div>

			<div class="i__group">
				<label class="label-checkbox" for="medico-consult-new">Mascota</label>
				<select name="medico-consult-new" id="medico-consult-new" required>
					<option value="">Seleccione la mascota</option>
					<?php foreach ($mascotas as $key => $value) : ?>
						<option value="<?=$value["idmascota"]?>"><?=$value["mascota"]?></option>
					<?php endforeach ?>
				</select>
			</div>
			
			<div class="i__group">
				<label class="label-checkbox" for="medico-consult-new">Médico que atendió</label>
				<select name="medico-consult-new" id="medico-consult-new" required>
					<option value="">Seleccione el médico</option>
					<?php foreach ($medicos as $key => $value) : ?>
						<option value="<?=$value["iduser"]?>"><?=$value["nombre"]?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="C__group">
				<div class="D-info">
					<p class="info"><i>i</i> Actualice los atributos de la mascota.</p>
				</div>
				
				<div class="i__group">
					<label class="labels" for="peso-pet-consult-new">Peso (Kg)</label>
					<input class="inputs" type="text" id="peso-pet-consult-new" name="peso-pet-consult-new" required>
				</div>
				
				<div class="i__group">
					<label class="i-b w100 label-checkbox">Tamaño</label>
					<input type="radio" name="tamano-pet-consult-new" id="pet-chico-consult-new" value="1" required>
					<label class="label-radio" for="pet-chico-consult-new">Chico</label>
					<input type="radio" name="tamano-pet-consult-new" id="pet-mediano-consult-new" value="2" required>
					<label class="label-radio" for="pet-mediano-consult-new">Mediano</label>
					<input type="radio" name="tamano-pet-consult-new" id="pet-grande-consult-new" value="3" required>
					<label class="label-radio" for="pet-grande-consult-new">Grande</label>
				</div>
				
				<div class="i__group">
					<label class="label-checkbox" for="cc-pet-consult-new">Condición corporal</label>
					<select name="cc-pet-consult-new" id="cc-pet-consult-new" required>
						<option value="">Seleccione la condición corporal</option>
						<option value="1">Delgado</option>
						<option value="2">Normal</option>
						<option value="2">Robusto</option>
					</select>
				</div>
			</div>
			
			<div class="i__group">
				<label class="label-checkbox" for="service-H-consult-new">Motivo de la Consulta</label>
				<div>
					<div id="checkbox">
						<input class="none" type="checkbox" name="service-H-consult-new" id="service-H-consult-new">
						<label for="service-H-consult-new">Hospitalización</label>
						<input class="none" type="checkbox" name="service-C-consult-new" id="service-C-consult-new">
						<label class="none" id="lbl-service-C-consult-new" for="service-C-consult-new">Cirujía</label>
					</div>
					<div id="checkbox">
						<input class="none" type="checkbox" name="service-M-consult-new" id="service-M-consult-new">
						<label id="lbl-service-M-consult-new" for="service-M-consult-new">Solo Medicación</label>
					</div>
				</div>
			</div>

			<div class="C__group">
				<label class="i-b w100 label-checkbox" for="acs-consult-new">Accesorios con los que llega la mascota a la consulta.</label>
				<div class="D-info">
					<p class="info"><i>i</i> Separe con una coma (,) cada accesorio.</p>
				</div>
				<div style="position: relative">
					<input class="inputs" type="text" name="acs-consult-new" id="acs-consult-new">
				</div>
			</div>

			<div class="i__group">
				<label class="labels" for="observaciones-consult-new">Observaciones</label>
				<textarea id="observaciones-consult-new" name="observaciones-consult-new" required></textarea>
			</div>
			
			<div class="i__group">
				<label class="labels" for="costo-consult-new">Costo de Consulta ($ MNX)</label>
				<input class="inputs" type="text" id="costo-consult-new" name="costo-consult-new" required>
			</div>
			
			<input type="hidden" name="pet-id-add-consult" id="pet-id-add-consult" required>
			<input type="submit" id="btn-MF" class="submit" value="Siguiente Paso">
			<?php ControladorServicios::nuevaConsultaCtl(); ?>
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
		<h2 class="f__title">Confirmación</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
		</div>
		<div class="D-info">
			<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
		</div>
		<input class="submit" type="submit" id="btn-C-delete-service" value="Confirmar">
		</form>
	</div>
</div>
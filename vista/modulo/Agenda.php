<?php 
	// $cargo = 0;
	// if(isset($_SESSION["tipo-usuario"])){
	// 	$cargo = $_SESSION["tipo-usuario"];
	// }
	
	// $size = 3;
	// $init = 0;
	// $inicio = 0;
	// $modulo = '';
	// if(isset($_GET["pag"])){
	// 	$init = $_GET["pag"];
	// }
	// if(isset($_GET["pagina"])){
	// 	$modulo = $_GET["pagina"];
	// }

	$arrayCitas = ControladorCita::selCitasCtl();
	// $paginacion = Paginacion::pnt($modulo, sizeof($arrayClientes), $init, $size);
	// $paginacion != null ? $inicio = $paginacion['inicio'] : null ;
	// $clientes = array_slice($arrayClientes, $inicio, $size);
?>

<div class="title">
	<h2>Citas</h2>
</div>

<?php //if($cargo == 1 || $cargo == 2) { ?>
<div class="C__Table">
	<div class="Bar__Btns">
		<div class="C__Btn">
			<input type="button" id="posponerBtn-s" class="btn" value="Posponer" disabled>
			<input type="button" id="cancelarBtn-s" class="btn" value="Cancelar" disabled>
		</div>
		<div class="C__Btn__Last">
			<input class="search" type="text" id="search-client" name="search-client" placeholder="Buscar Paciente">
			<span class="iconSearch">
				<!-- <image src="img/search_20px.png"></image> -->
			</span>
		</div>
	</div>

	<table class="table" id="tbl-citas">
		<tr>
			<th>
				<input type="checkbox" name="checkCitas" id="checkCitas">
			</th>
			<th>Paciente</th>
			<th>Fecha de cita</th>
			<th>Número de teléfono</th>
		</tr>
			<?php foreach($arrayCitas as $key => $value) : ?>
			
		<tr name="citas-row">
			<td>
				<input type="checkbox" name="checkCita" id="checkCita<?=$value["idCita"]?>" value="<?=$value["idCita"]?>">
			</td>
			<td id="<?=$value["idCita"]?>" name="citas-table">
				<?=$value["nombre"].' '.$value["apellidos"]?>
			</td>
			<td id="<?=$value["idCita"]?>" name="citas-table"><?=$value["fechaCita"]?></td>
			<td id="<?=$value["idCita"]?>" name="citas-table"><?=$value["telefono"]?></td>
		</tr>
			<?php endforeach ?>
	</table>

	<div class="C__f oculto" id="form-add-client">
		<form method="post" class="f">
			<input class="f__close" type="button" id="btn-close-form-add-client" value="x">
			<h2 class="f__title">Crear Cliente</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<input class="inputs" type="text" id="cliente-new" name="cliente-new" required>
				<label class="labels" for="cliente-new">Nombre del cliente</label>
			</div>

			<div class="i__group">
				<label class="label-checkbox" for="vinculo-animal">Registrar vínculo animal</label>
				<input type="checkbox" name="vinculo-animal" id="vinculo-animal">
				<div class="D-info">
					<p class="info"><i>i</i> Active la casilla si desea registrar los datos de una mascota a nombre de ese cliente.</p>
				</div>
			</div>
			
			<input class="submit" type="submit" value="Crear">
			<?php //ControladorCliente::crearClienteCtl(); ?>
		</form>
	</div>

	<div class="C__f oculto" id="posponerForm">
		<form method="post" class="f">
		<input class="f__close" type="button" id="posponerBtn-x" value="x">
			<h2 class="f__title">Posponer cita</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<input class="textfield" type="datetime-local" name="posponerTiempo" id="posponerTiempo" required>
				<label class="labels" for="posponerTiempo">Fecha y Hora</label>
			</div>

			<input type="hidden" name="posponerId" id="posponerId" required>
			<input class="submit" type="submit" value="Posponer">
			<?php //$actualizarCliente = ControladorCliente::actualizarClienteCtl(); ?>
		</form>
	</div>
	
	<div class="C__f oculto" id="form-delete-client">
		<form method="post" class="f">
			<input class="f__close" type="button" id="btn-close-form-delete-client" value="x">
			<h2 class="f__title">Confirmación</h2>
			<div class="line-top"></div>
			<div class="i__group">
				<span class="label-checkbox">¿Desea eliminar los registros seleccionados?</span>
			</div>
			<div class="D-info">
				<p class="info"><i>i</i> También se eliminarán los datos pertenecientes a este registro.</p>
			</div>
			<input class="submit" type="button" id="btn-C-delete-client" value="Confirmar">
		</form>
	</div>
</div>
<?php //} ?>
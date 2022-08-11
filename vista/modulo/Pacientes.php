<?php
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

	$arrayPacientes = ControladorPaciente::selPacientesCtl();
	// $arrayPacientes = array(
	// 	array(
	// 		'idUsuario' => '1', 
	// 		'nombre' => 'Bernadette', 
	// 		'apellidos' => 'Hills', 
	// 		'fechaRegistro' => '13-ene-2022 10:00 hrs'
	// 	)
	// );
	$totalPacientes = ControladorPaciente::contarPacientesCtl()["totalPacientes"];
	$mostrando = sizeof($arrayPacientes);
	// $paginacion = Paginacion::pnt($modulo, sizeof($arrayClientes), $init, $size);
	// $paginacion != null ? $inicio = $paginacion['inicio'] : null ;
	// $clientes = array_slice($arrayClientes, $inicio, $size);
?>
<div class="title">
	<h2>Pacientes</h2>
</div>

<?php if(!$arrayPacientes) { ?>
<div class="C__Table">
	<div class="Bar__Btns">
		<div class="C__Btn">
			<input type="button" id="pacienteNBtn-s" class="btn" value=" + Nuevo">
		</div>
		<div class="info nodata">
			<span>No hay pacientes registrados</span>
		</div>
	</div>
</div>
<?php } else { ?>
<div class="C__Table">
	<div class="Bar__Btns">
		<div class="C__Btn">
			<input type="button" id="pacienteNBtn-s" class="btn" value=" + Nuevo">
			<input type="button" id="pacienteABtn-s" class="btn" value="Actualizar" disabled>
			<input type="button" id="pacienteFBtn-s" class="btn" value="Archivar" disabled>
		</div>
		<div class="C__Btn">
			<span class="results" id="results"><?=$mostrando?> resultados de <?=$totalPacientes?></span>
		</div>
		<div class="C__Btn__Last">
			<input class="search" type="text" id="pacienteBtn-b" name="pacienteBtn-b" placeholder="Buscar Paciente">
		</div>
	</div>

	<table class="table" id="tbl-pacientes">
		<tr>
			<th>
				<input type="checkbox" name="checkPacientes" id="checkPacientes">
			</th>
			<th>Nombre</th>
			<th>Fecha de registro</th>
			<th>Expediente</th>
		</tr>
			<?php 
				foreach($arrayPacientes as $key => $value) : 
					$nombre = $value["nombre"].' '.$value["apellidos"];
					//$expediente = $value["expediente"];
			?>
		<tr name="pacientes-row">
			<td>
				<input type="checkbox" name="checkPaciente" id="checkPaciente<?=$value["idUsuario"]?>" value="<?=$value["idUsuario"]?>">
			</td>
			<td id="<?=$value["idUsuario"]?>" name="checkPaciente"><?=$nombre?></td>
			<td id="<?=$value["idUsuario"]?>" name="checkPaciente"><?=$value["fechaRegistro"]?></td>
			<td id="<?=$value["idUsuario"]?>" name="checkPaciente">
				<a class="btn" href="index.php?pagina=PacienteInfo&expediente=<?=$value["idUsuario"]?>">Expediente</a>
			</td>
		</tr>
			<?php endforeach ?>
	</table>
</div>

<div class="C__f oculto" id="pacienteAForm">
	<form method="post" class="f">
		<span class="f__x" id="pacienteABtn-x"></span>
		<h2 class="f__title">Actualizar Paciente</h2>
		<div class="line-top"></div>
		<div class="iflex">
			<div class="i__group">
				<input class="textfield" type="text" id="pacienteNombre-A" name="pacienteNombre-A" autofocus required>
				<label class="labels" for="pacienteNombre-A">Nombre</label>
			</div>
			<div class="i__group">
				<input class="textfield" type="text" id="pacienteApellidos-A" name="pacienteApellidos-A" required>
				<label class="labels" for="pacienteApellidos-A">Apellidos</label>
			</div>
		</div>
		<div class="i__group">
			<input class="textfield" type="tel" id="pacienteTelefono-A" name="pacienteTelefono-A" required>
			<label class="labels" for="pacienteTelefono-A">Teléfono</label>
		</div>

		<div>
			<input type="hidden" name="idPaciente-A" id="idPaciente-A" required>
			<input class="submit" type="submit" value="Actualizar">
			<?php //ControladorUsuario::actualizarUsuarioCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="pacienteFForm">
	<form method="post" class="f">
		<span class="f__x" id="pacienteFBtn-x"></span>
		<h2 class="f__title">Archivar pacientes</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">Los pacientes seleccionados, serán archivados para su futura consulta, no serán eliminados, pero pasarán a estar inactivos en el sistema.</span>
		</div>
		<input class="submit" type="button" id="pacienteFBtn-C" value="Aceptar">
	</form>
</div>

<?php } ?>

<div class="C__f oculto" id="pacienteNForm">
	<form method="post" class="f">
		<span class="f__x" id="pacienteNBtn-x"></span>
		<h2 class="f__title">Nuevo Paciente</h2>
		<div class="line-top"></div>
		<div class="iflex">
			<div class="i__group">
				<input class="textfield" type="text" id="pacienteNombre-N" name="pacienteNombre-N" autofocus required>
				<label class="labels" for="pacienteNombre-N">Nombre</label>
			</div>
			<div class="i__group">
				<input class="textfield" type="text" id="pacienteApellidos-N" name="pacienteApellidos-N" required>
				<label class="labels" for="pacienteApellidos-N">Apellidos</label>
			</div>
		</div>
		<div class="i__group">
			<input class="textfield" type="tel" id="pacienteTelefono-N" name="pacienteTelefono-N" required>
			<label class="labels" for="pacienteTelefono-N">Teléfono</label>
		</div>
		<div>
			<input class="submit" type="submit" value="Agregar">
			<?php //ControladorUsuario::crearCuentaCtl(); ?>
		</div>
	</form>
</div>
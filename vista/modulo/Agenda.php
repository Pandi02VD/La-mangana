<?php 
	$cargo = 0;
	if(isset($_SESSION["tipo-usuario"])){
		$cargo = $_SESSION["tipo-usuario"];
	}
	
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

	$arrayCitas = ControladorAgenda::selCitasCtl();
	$totalCitas = ControladorAgenda::contarCitasCtl()["totalCitas"];
	$mostrando = sizeof($arrayCitas);
	$config = ControladorUsuario::selConfigCtl(1);
	// $paginacion = Paginacion::pnt($modulo, sizeof($arrayClientes), $init, $size);
	// $paginacion != null ? $inicio = $paginacion['inicio'] : null ;
	// $clientes = array_slice($arrayClientes, $inicio, $size);
?>
<div class="title">
	<h2>Agenda</h2>
</div>

<?php if($cargo >= 1) { ?>
<div class="C__Table">
	<div class="Bar__Btns">
		<div class="C__Btn">
			<input type="button" id="citaBtn-s" class="btn" value=" + Nueva">
			<input type="button" id="posponerBtn-s" class="btn" value="Posponer" disabled>
			<input type="button" id="cancelarBtn-s" class="btn" value="Cancelar" disabled>
		</div>
		<div class="C__Btn">
			<span class="results" id="results"><?=$mostrando?> resultados de <?=$totalCitas?></span>
		</div>
		<div class="C__Btn__Last">
			<input class="search" type="text" id="citaBtn-b" name="citaBtn-b" placeholder="Buscar Paciente">
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
			<th>Asistencia</th>
		</tr>
			<?php foreach($arrayCitas as $key => $value) : ?>
			<?php
				$fechaA = strtotime(DataArrays::getFecha());
				$fechaB = strtotime($value["fechaCiF"]);
				$Confirmar;
				($fechaA > $fechaB) ? $confirmar = 'Recuperar' : $confirmar = 'Confirmar';
			?>
		<tr name="citas-row <?=$confirmar?>">
			<td>
				<input type="checkbox" name="checkCita" id="checkCita<?=$value["idCita"]?>" value="<?=$value["idCita"]?>">
			</td>
			<td id="<?=$value["idCita"]?>" name="checkCita"><?=$value["nombre"].' '.$value["apellidos"]?>
			</td>
			<td id="<?=$value["idCita"]?>" name="checkCita"><?=$value["fechaCi"]?> hrs</td>
			<td id="<?=$value["idCita"]?>" name="checkCita"><?=$value["telefono"]?></td>
			<td id="<?=$value["idCita"]?>" name="checkCita">
				<input type="button" name="citaBtn-C" class="btn" value="<?=$confirmar?>">
			</td>
		</tr>
			<?php endforeach ?>
	</table>
</div>

<div class="C__f oculto" id="posponerForm">
	<form method="post" class="f">
		<span class="f__x" id="posponerBtn-x"></span>
		<h2 class="f__title">Posponer cita</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<input class="textfield" type="datetime-local" name="posponerTiempo" id="posponerTiempo" required>
			<label class="labels" for="posponerTiempo">Fecha y Hora</label>
		</div>

		<input type="hidden" name="idPosponer" id="idPosponer" required>
		<input class="submit" type="submit" value="Posponer">
		<?php ControladorAgenda::posponerCitaCtl(); ?>
	</form>
</div>

<div class="C__f oculto" id="cancelarForm">
	<form method="post" class="f">
		<span class="f__x" id="cancelarBtn-x"></span>
		<h2 class="f__title">Cancelar</h2>
		<div class="line-top"></div>
		<div class="i__group">
			<span class="label-checkbox">¿Cancelar las citas seleccionadas?</span>
		</div>
		<input class="submit" type="button" id="cancelarBtn-C" value="Aceptar">
	</form>
</div>

<?php } elseif ($cargo == 0) { ?>
	
<?php } ?>

<div class="C__f oculto" id="citaForm">
	<form method="post" class="f">
		<span class="f__x" id="citaBtn-x"></span>
		<h2 class="f__title">Agendar cita</h2>
		<div class="iflex">
			<div class="i__group">
				<input class="textfield" type="text" id="citaNombre-n" name="citaNombre-n" autofocus required>
				<label class="labels" for="citaNombre-n">Nombre</label>
			</div>
			<div class="i__group">
				<input class="textfield" type="text" id="citaApellidos-n" name="citaApellidos-n" required>
				<label class="labels" for="citaApellidos-n">Apellidos</label>
			</div>
		</div>
		<div class="i__group">
			<input class="textfield" type="tel" name="citaTelefono-n" id="citaTelefono-n" required>
			<label class="labels" for="citaTelefono-n">Número de teléfono</label>
		</div>
		<div class="iflex">
			<div class="i__group">
				<input class="textfield" type="date" id="citaFecha-n" name="citaFecha-n" required>
				<label class="labels" for="citaFecha-n">Fecha</label>
			</div>
			<div class="i__group">
				<input class="textfield" type="time" id="citaHora-n" name="citaHora-n" required>
				<label class="labels" for="citaHora-n">hora</label>
			</div>
		</div>
		<div class="i__group" style="margin-top: 10px;">
			<?php if(!$config) : ?>
				<div class= "nodata"><span>Horario de Martes a Domingo de 10:00 a 18:30</span></div>
			<?php else : $configJSON = DataArrays::getFechaConfig(json_decode($config["configJSON"]));?>
				<div class= "nodata"><span>Horario <?=$configJSON?></span></div>
			<?php endif ?>
			</div>
		<div>
			<input class="submit" type="submit" value="Agendar">
			<?php ControladorExterno::agendarCitaCtl(); ?>
		</div>
	</form>
</div>

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
			<input class="textfield" type="text" id="pacienteTelefono-N" name="pacienteTelefono-N" required>
			<label class="labels" for="pacienteTelefono-N">Teléfono</label>
		</div>
		<div>
			<input type="hidden" name="idCitaC" id="idCitaC">
			<input class="submit" type="submit" value="Confirmar">
			<?php ControladorPaciente::nuevoPacienteCtl(); ?>
		</div>
	</form>
</div>
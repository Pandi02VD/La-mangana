<?php 
	$cargo = 0;
	$idUsuario = 0;
	if(isset($_SESSION["tipo-usuario"])){
		$cargo = $_SESSION["tipo-usuario"];
	}
	if(isset($_SESSION["usuario"])){
		$idUsuario = $_SESSION["usuario"];
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

	$config = ControladorUsuario::selConfigCtl($idUsuario);
	// $paginacion = Paginacion::pnt($modulo, sizeof($arrayClientes), $init, $size);
	// $paginacion != null ? $inicio = $paginacion['inicio'] : null ;
	// $clientes = array_slice($arrayClientes, $inicio, $size);
?>
<div class="title">
	<h2>Configuración</h2>
</div>

<div class="C__Table center">
	<div class="Bar__Btns column w70">
		<span class="Lbl__Bar">Información Personal</span>
		<div class="C__Btn">
			<a href="MisDatos" id="misDatosBtn" class="btn">Mis Datos</a>
		</div>
	</div>
	<div class="Bar__Btns column w70">
		<span class="Lbl__Bar">Seguridad</span>
		<div class="C__Btn">
			<input type="button" id="changePwdBtn-s" class="btn" value="Cambiar Contraseña">
		</div>
	</div>
	<div class="Bar__Btns column w70">
		<span class="Lbl__Bar">Horario laboral</span>
		<div class="C__Btn">
			<input type="button" id="horarioNBtn-s" class="btn" value="Establecer horario laboral">
		</div>
		<?php if(!$config) : ?>
			<div class="info nodata">
				<span>No se ha establecido un horario laboral</span>
			</div>
		<?php else : $configJSON = DataArrays::getFechaConfig(json_decode($config["configJSON"]));?>
			<div class="lista">
				<div class="listaItem">
					<div>
						<span><?=$configJSON?></span>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>

<div class="C__f oculto" id="changePwdForm">
	<form method="post" class="f">
		<span class="f__x" id="changePwdBtn-x"></span>
		<h2 class="f__title">Cambiar Contraseña</h2>
		<div class="i__group">
			<input class="textfield" type="password" id="pwdActual" name="pwdActual" autofocus required>
			<label class="labels" for="pwdActual">Contraseña actual</label>
		</div>
		<div class="i__group">
			<input class="textfield" type="password" id="pwdNueva" name="pwdNueva" required>
			<label class="labels" for="pwdNueva">Contraseña nueva</label>
		</div>
		<div>
			<input type="hidden" name="pwdUsuarioId" id="pwdUsuarioId" value="<?=$idUsuario?>">
			<input class="submit" type="submit" value="Enviar">
			<?php ControladorUsuario::actualizarPicCtl(); ?>
		</div>
	</form>
</div>

<div class="C__f oculto" id="horarioNForm">
	<form method="post" class="f">
		<span class="f__x" id="horarioNBtn-x"></span>
		<h2 class="f__title">Establecer horario laboral</h2>
		<div class="iflex nowrap">
			<div class="i__group">
				<input type="checkbox" name="horarioDia1-n" id="horarioDia1-n">
				<label class="labels" for="horarioDia1-n">L</label>
			</div>
			<div class="i__group">
				<input type="checkbox" name="horarioDia2-n" id="horarioDia2-n">
				<label class="labels" for="horarioDia2-n">M</label>
			</div>
			<div class="i__group">
				<input type="checkbox" name="horarioDia3-n" id="horarioDia3-n">
				<label class="labels" for="horarioDia3-n">M</label>
			</div>
			<div class="i__group">
				<input type="checkbox" name="horarioDia4-n" id="horarioDia4-n">
				<label class="labels" for="horarioDia4-n">J</label>
			</div>
			<div class="i__group">
				<input type="checkbox" name="horarioDia5-n" id="horarioDia5-n">
				<label class="labels" for="horarioDia5-n">V</label>
			</div>
			<div class="i__group">
				<input type="checkbox" name="horarioDia6-n" id="horarioDia6-n">
				<label class="labels" for="horarioDia6-n">S</label>
			</div>
			<div class="i__group">
				<input type="checkbox" name="horarioDia7-n" id="horarioDia7-n">
				<label class="labels" for="horarioDia7-n">D</label>
			</div>
		</div>
		<div class="iflex">
			<div class="i__group">
				<input class="textfield" type="time" id="horarioHoraA-n" name="horarioHoraA-n" required>
				<label class="labels" for="horarioHoraA-n">Hora de abrir</label>
			</div>
			<div class="i__group">
				<input class="textfield" type="time" id="horarioHoraC-n" name="horarioHoraC-n" required>
				<label class="labels" for="horarioHoraC-n">Hora de cerrar</label>
			</div>
		</div>
		<div>
			<input type="hidden" name="horarioUsuarioId-n" id="horarioUsuarioId-n" value="<?=$idUsuario?>">
			<input class="submit" type="submit" value="Establecer horario">
			<?php ControladorUsuario::nuevoHorarioCtl(); ?>
		</div>
	</form>
</div>
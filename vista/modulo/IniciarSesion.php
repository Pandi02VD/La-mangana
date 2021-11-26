<?php
	if(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"])) {
		echo '<script>window.location = "Inicio"</script>';
	}
?>
<div class="bgTop"></div>
<div class="bgBottom">
	<div>
		<h1>Inicia Sesión</h1>
		<form method="post" class="">
			<div class="i__group">
				<input class="textfield" type="text" id="usuario" name="usuario" autofocus>
				<label class="labels" for="usuario">Nombre de usuario</label>
			</div>
			<div class="i__group">
				<input class="textfield pwd" type="password" id="contrasena" name="contrasena">
				<label class="labels" for="contrasena">Contraseña</label>
			</div>
			<div>
				<input class="submit" type="submit" value="Iniciar">
				<?php ControladorUsuario::iniciarSesionCtl(); ?>
			</div>
		</form>
	</div>
</div>
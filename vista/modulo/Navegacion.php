<?php isset($_SESSION["ingresado"]) ? $login = true : $login = false; ?>
<div class="nav">
	<nav>
		<div class="D-Logo">
			<img class="Logo" src="img/LogoNombre_G.png" alt="Logotipo">
		</div>
		<div class="mainTitle">La Mangana</div>
		<?php if($login) : ?>
			<div class="saludo">
				<a class="link-button" id="Salir" href="index.php?pagina=Salir">Salir</a>
			</div>
			<div class="saludo">
				<span id="saludo">¡Hola</span><?="! ".$_SESSION["ingresado"]?>
			</div>
		<?php endif ?>
	</nav>
	
	<div class="buttonsBar">
		<div class="D-link-buttons">
			<?php if(!$login) { ?>
				<a class="link-button" id="IniciarSesion" href="index.php?pagina=IniciarSesion">Iniciar Sesión</a>
			<?php } else { ?>
				<a class="link-button" id="Inicio" href="index.php?pagina=Inicio">Inicio</a>
				<a class="link-button" id="Mascotas" href="index.php?pagina=Mascotas">Mascotas</a>
				<a class="link-button" id="Clientes" href="index.php?pagina=Clientes">Clientes & Usuarios</a>
			<?php } ?>
		</div>
	</div>
</div>
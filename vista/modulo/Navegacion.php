<?php isset($_SESSION["ingresado"]) ? $login = true : $login = false; ?>
<nav>
	<div class="logo">
		<img src="img/ECONODENTALPLUS LOGO.png" alt="Logotipo">
	</div>
	<h1 class="none">Econodental Plus</h1>
	
	<?php $login ? $usuario = substr($_SESSION["ingresado"], 0, 20) : $usuario = 'Usuario1' ?>
	<div id="menuBar" class="menuBar">
		<div id="userBar" class="userBar">
			<div>
				<span class="bars"></span>
			</div>
			<div>
				<span id="nombreUsuario"><?=$usuario?></span>
			</div>
		</div>
		<div class="bar">
			<?php if($login) { ?>
				<a class="link-btn" id="Inicio" href="Inicio">Inicio</a>
				<a class="link-btn" id="Agenda" href="Agenda">Agenda</a>
				<a class="link-btn" id="Pacientes" href="Pacientes">Pacientes</a>
				<a class="link-btn" id="Usuarios" href="Usuarios">Usuarios</a>
				<a class="link-btn" id="Configuracion" href="Configuracion">Configuración</a>
				<a class="link-btn" id="Salir" href="Salir">Salir</a>
			<?php } else { ?>
				<a class="link-btn" id="IniciarSesion" href="IniciarSesion">Iniciar Sesion</a>
				<a class="link-btn" id="Cita" href="Cita">Cita</a>
			<?php } ?>
		</div>
	</div>
</nav>
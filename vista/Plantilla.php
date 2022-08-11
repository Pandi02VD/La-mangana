<?php 
	session_start();
	date_default_timezone_set('America/Mexico_City');
	$page = '';
	if (isset($_GET["pagina"])) {
		$page = $_GET["pagina"];
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="Clinica dental, Dentista, Dientes, Brackets">
		<meta name="theme-color" content="#342EED">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<title>Econodental Plus</title>
		<link rel="shortcut icon" href="img/ECONODENTALPLUS LOGO.png" type="image/x-icon">

		<!-- Acceso a jquery -->
		<script src="lib/jquery-3.4.1.min.js"></script>

		<!-- Fuentes -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;600&family=Nunito+Sans:wght@300;400;700&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
		
		<!-- Estilos -->
		<?php if($page != "HistoriaMedica") : ?>
			<link rel="stylesheet" href="css/Estilos.css">
		<?php endif ?>

		<!-- API Google Places -->
		<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>

		<!-- Notificaciones -->
		<script src="js/Notificaciones.js"></script>
	</head>
	<body>
		<header>
			<?php
				$page != "HistoriaMedica" ? include "vista/modulo/Navegacion.php" : null ; 
			?>
		</header>
		<main>
			<?php $ctrl = new Controlador(); ?>
			<?php $ctrl -> getPaginaCtl(); ?>
		</main>
		<footer></footer>
	</body>
	<!-- Scripts -->
	<script src="js/All.js" type="module"></script>
</html>
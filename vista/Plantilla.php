<?php 
	session_start();
	date_default_timezone_set('America/Mexico_City');
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
		<link rel="stylesheet" href="css/morris.css">
		<!-- <link rel="stylesheet" href="css/Estilo.css"> -->
		<link rel="stylesheet" href="css/Estilos.css">

		<!-- Notificaciones -->
		<script src="js/Notificaciones.js"></script>
	</head>
	<body>
		<header>
			<?php include "vista/modulo/Navegacion.php"; ?>
		</header>
		<main>
			<?php $ctrl = new Controlador(); ?>
			<?php $ctrl -> getPaginaCtl(); ?>
		</main>
		<footer></footer>
	</body>
	<!-- Scripts -->
	<script src="js/Pagina.js"></script>
	<script src="js/All.js"></script>
	<!-- <script src="js/Datos.js"></script> -->
	<!-- <script src="js/Graficas.js"></script> -->
	<!-- <script src="js/ExcelExportar.js"></script> -->
	<!-- <script src="js/JQueryAcciones.js"></script> -->
	<script src="js/Validaciones.js"></script>
	<script src="js/Interactividad.js"></script>
	<!-- <script src="js/CronoAcciones.js"></script> -->
</html>
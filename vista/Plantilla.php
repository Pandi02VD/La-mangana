<?php 
	session_start();
	date_default_timezone_set('America/Mexico_City');
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>La mangana</title>
		<link rel="shortcut icon" href="img/L.svg" type="image/x-icon">

		<!-- Librerías -->
		<!-- <script src="vista/lib/html2pdf.bundle.min.js"></script> -->
		<script src="vista/lib/jquery-3.4.1.min.js"></script>
		<script src="vista/lib/morris.min.js"></script>
		<script src="vista/lib/raphael-min.js"></script>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js" integrity="sha512-Lii3WMtgA0C0qmmkdCpsG0Gjr6M0ajRyQRQSbTF6BsrVh/nhZdHpVZ76iMIPvQwz1eoXC3DmAg9K51qT5/dEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

		<!-- Fuentes -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500&family=Nunito+Sans:wght@300;400;700&family=Roboto:wght@100;400&family=Sarabun:ital,wght@0,100;0,400;1,100&display=swap" rel="stylesheet">
		
		<!-- Estilos -->
		<link rel="stylesheet" href="css/morris.css">
		<link rel="stylesheet" href="css/Estilo.css">

		<!-- API Google Places -->
		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>

		<!-- Notificaiones JS -->
		<script src="js/Notificaciones.js"></script>
	</head>
	<body>
		<?php include "vista/modulo/Navegacion.php"; ?>
		<main>
			<?php $ctrl = new Controlador(); ?>
			<?php $ctrl -> traerPaginaCtl(); ?>
		</main>
		<footer>
			<?php include "vista/modulo/Footer.php"; ?>
		</footer>
		<script src="js/Pagina.js"></script>
		<script src="js/Datos.js"></script>
		<script src="js/Graficas.js"></script>
		<script src="js/ExcelExportar.js"></script>
		<script src="js/JQueryAcciones.js"></script>
		<script src="js/Validaciones.js"></script>
		<script src="js/Interactividad.js"></script>
		<script src="js/CronoAcciones.js"></script>
	</body>
</html>
<?php session_start();?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La mangana</title>
    <link rel="shortcut icon" href="img/L.svg" type="image/x-icon">

    <!-- Librerías -->
    <script src="vista/lib/jquery-3.4.1.min.js"></script>
    <script src="vista/lib/morris.min.js"></script>
    <script src="vista/lib/raphael-min.js"></script>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="css/morris.css">
    <link rel="stylesheet" href="css/Estilo.css">

    <!-- API Google Places -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
</head>
<body>
    <?php include "vista/modulo/Navegacion.php"; ?>
    <main>
        <?php $contrl = new Controlador(); ?>
        <?php $contrl -> traerPaginaCtl(); ?>
    </main>
    
    <!-- Scripts -->
    <script src="js/Datos.js"></script>
    <script src="js/Graficas.js"></script>
    <script src="js/ExcelExportar.js"></script>
    <script src="js/JQueryAcciones.js"></script>
    <script src="js/Interactividad.js"></script>
    <script src="js/CronoAcciones.js"></script>
</body>
</html>
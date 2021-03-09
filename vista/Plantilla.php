<?php session_start();?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La mangana</title>
    <link rel="shortcut icon" href="img/L.svg" type="image/x-icon">
    <script src="vista/scripts/jquery-3.4.1.min.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/morris.css">
    <link rel="stylesheet" href="css/Estilo.css">
</head>
<body>
    <?php
        include "vista/modulo/Navegacion.php";
        $contrl = new Controlador();
        $contrl -> traerPaginaCtl();
    ?>
    <script src="js/Datos.js"></script>
    <script src="js/Graficas.js"></script>
    <script src="js/Interactividad.js"></script>
    <script src="js/JQueryAcciones.js"></script>
    <script src="js/CronoAcciones.js"></script>
</body>
</html>
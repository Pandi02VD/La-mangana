<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La mangana</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
    <style>
        *{font-family: 'Nunito Sans', sans-serif, arial}
    </style>
</head>
<body>
    <?php
        include "vista/modulo/Navegacion.php";
        $contrl = new Controlador();
        $contrl -> traerPaginaCtl();
    ?>
    <script src="js/Datos.js"></script>
    <script src="js/Interactividad.js"></script>
    <script src="js/CronoAcciones.js"></script>
</body>
</html>
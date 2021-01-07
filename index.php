<?php
    require_once 'modelo/Pagina.php';
    require_once 'modelo/CRUD.php';
    require_once 'controlador/Controlador.php';
    $main = new Controlador();
    $main -> plantilla();
?>
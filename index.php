<?php
	require_once 'modelo/Pagina.php';
	require_once 'modelo/Acceso.php';
	require_once 'modelo/CRUD.php';
	require_once 'modelo/CRUDCliente.php';
	require_once 'modelo/CRUDMascota.php';
	require_once 'modelo/CRUDUsuario.php';
	require_once 'controlador/Controlador.php';
	require_once 'controlador/ControladorCliente.php';
	require_once 'controlador/ControladorMascota.php';
	require_once 'controlador/ControladorUsuario.php';
	require_once 'controlador/Validacion.php';
	require_once 'controlador/Pic.php';
	$main = new Controlador();
	$main -> plantilla();

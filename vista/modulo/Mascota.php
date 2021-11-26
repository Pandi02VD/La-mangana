<?php 
	$nameGET = 'um';
	$mascotaId = $_GET[$nameGET];
	$mascota = ControladorMascota::seleccionarMascotaCtl($mascotaId);
?>
<div class="title">
	<h2>Mascota</h2>
	<h3><?=$mascota["mascota"]?></h3>
</div>
<!-- <div style="display: inline-block; width: auto"> -->
	<div>
		<input type="hidden" name="mascotaId" id="mascotaId" value="<?=$mascotaId?>">
		<div id="graficaPeso"></div>
	</div>
<!-- </div> -->

<!-- <div style="display: inline-block; width: auto">
	<video src="video/Animacion.mp4" controls></video>
</div> -->
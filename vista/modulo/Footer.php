<?php
	$mascotas = ControladorMascota::listarMascotasCtl();
?>

<div class="C__f oculto" id="form-HistoriaClinica">
	<form method="get" class="f">
	<input class="f__close" type="button" id="close-form-HistoriaClinica" value="x">
	<h2 class="f__title">Seleccionar mascota</h2>
	<div class="line-top"></div>
	<div class="i__group">
		<label class="label-checkbox" for="mascota">Mascota</label>
		<input type="hidden" name="pagina" value="HistoriaClinica">
		<select name="um" id="um" required>
			<?php foreach ($mascotas as $key => $v) : ?>
				<option value="<?=$v["idmascota"]?>"><?=$v["mascota"]?></option>
			<?php endforeach; ?>
		</select>
	</div>
	
	<input class="submit" type="submit" value="Buscar">
	<?php 
		//$crearUsuario = ControladorUsuario::crearCuentaCtl();
	?>
	</form>
</div>

<div class="contentAbout">
	<h3 class="titleFooter">La Mangana</h3>
	<p>En Farmacia Veterinaria La Mangana ofrecemos un excelente servicio veterinario, para cuidar de la salud de perros y gatos en diversas áreas. Contamos con instalaciones y equipo de vanguardia para la comodidad de nuestros pacientes y sus propietarios, siempre con el objetivo de dar la mejor atención. Trabajamos basándonos siempre en la honestidad, responsabilidad, respeto y sensibilidad.</p>
</div>

<div class="contentMap">
	<h3 class="titleFooter">Ubicación</h3>
	<a target="_blank" href="https://www.google.com/maps/place/Farmacia+Veterinaria+y+Estética+Canina+La+Mangana/@20.0628509,-97.0530458,19.5z/data=!4m16!1m10!4m9!1m4!2m2!1d-97.1467177!2d20.0080585!4e1!1m3!2m2!1d-97.05333!2d20.06279!3m4!1s0x85dafd72858d704d:0x4d67d037faaea2e0!8m2!3d20.0629099!4d-97.0531902">
		<address>
			<img src="img/Location_18px.png" alt="Ubicación">Av. Máximino Ávila Camacho 309 A, Centro, 93600 Martínez de la Torre, Ver.
		</address>
	</a>
	<img id="mapa" src="https://maps.googleapis.com/maps/api/staticmap?center=20.062929172919276, -97.05318660540844&zoom=18&size=350x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C20.062929172919276, -97.053186605408448&key=" alt="Mapa">
</div>

<div class="contentNet">
	<h3 class="titleFooter">Redes</h3>
	<div>
		<a target="_blank" href="https://twitter.com/">
			<img src="img/twitter_32px.png" alt="Twitter">
			<span class="tooltip">Twitter</span>
		</a>
		<a target="_blank" href="https://www.facebook.com/lamanganaveterinaria/">
			<img src="img/facebook_32px.png" alt="Facebook">
			<span class="tooltip">Facebook</span>
		</a>
		<a target="_blank" href="https://www.instagram.com/lamanganaveterinaria/">
			<img src="img/Instagram_32px.png" alt="Instagram">
			<span class="tooltip">Instagram</span>
		</a>
	</div>
</div>

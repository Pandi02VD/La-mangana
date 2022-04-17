<?php
	$mascotasActivas = ControladorMascota::mascotasActivasCtl();
	$mascotasHoy = ControladorMascota::mascotasHoyCtl();
	$mascotasMes = ControladorMascota::mascotasMesCtl();
	$mascotasPromedio = ControladorMascota::mascotasPromedioMesCtl();
	print_r($mascotasPromedio);
?>

<div class="title">
	<h2>Inicio</h2>
</div>

<div class="banner">
	<img src="img/banner.jpg" alt="banner">
	<div class="txtBanner">
		<span>Servirle a tu mascota es un placer!</span>
	</div>
</div>

<div class="Section" id="Activos">
	<h3 class="subTitle">Pacientes activos</h3>
	<ul>
	<?php foreach ($mascotasActivas AS $k => $v) : 
			$ultimasConsultas = ControladorMascota::ultimasConsultasCtl($v["idmascota"]); 
	?>
		<li>
			<div><span><?=$v["mascota"]?></span></div>
			<div>
				<?php foreach ($ultimasConsultas AS $key => $val) : ?>
					<span><?=$val["momento"]?></span>
				<?php endforeach; ?>
			</div>
			<div><span>Prop: <?=$v["prop"]?></span></div>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

<div class="Section" id="Resumen">
	<h3 class="subTitle">Resumen Pacientes Atendidos</h3>
	<div class="C__Resumen">
		<div>
			<p><?=$mascotasHoy["hoy"]?></p>
			<h3>Hoy</h3>
		</div>
		<div>
			<p><?=$mascotasMes["mes"]?></p>
			<h3>Este mes</h3>
		</div>
		<div>
			<p><?=$mascotasPromedio["promedio"] / $mascotasPromedio["dias"]?></p>
			<h3>Promedio diario</h3>
		</div>
	</div>
	<div id="graficaMes"></div>
</div>

<div class="Section" id="Blocks">
	<h3 class="subTitle">Todos nuestros servicios</h3>
	<div class="Blocks">
		<a class="blocks" target="_blank" href="https://www.facebook.com/lamanganaveterinaria/">
			<div class="titleBlock">Estética canina</div>
			<div class="imgBlock"><img src="img/grooming_75px.png" alt="Estética canina"></div>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur blanditiis laborum nam cupiditate culpa obcaecati a, nihil nobis deserunt aut sint voluptatibus tenetur corporis delectus eos molestiae et dolores pariatur!</p>
		</a>
		<a class="blocks" target="_blank" href="https://wa.me/message/RAG5Q2GD4VTDE1">
			<div class="titleBlock">Farmacia Veterinaria</div>
			<div class="imgBlock"><img src="img/dog_cone_75px.png" alt="Farmacia Veterinaria"></div>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur blanditiis laborum nam cupiditate culpa obcaecati a, nihil nobis deserunt aut sint voluptatibus tenetur corporis delectus eos molestiae et dolores pariatur!</p>
		</a>
		<a class="blocks" href="index.php?pagina=Orientacion">
			<div class="titleBlock">Orientación</div>
			<div class="imgBlock"><img src="img/look_after_75px.png" alt="Orientación"></div>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur blanditiis laborum nam cupiditate culpa obcaecati a, nihil nobis deserunt aut sint voluptatibus tenetur corporis delectus eos molestiae et dolores pariatur!</p>
		</a>
		<a class="blocks" href="index.php?pagina=Hospitalizacion">
			<div class="titleBlock">Hospital Veterinario</div>
			<div class="imgBlock"><img src="img/veterinary_examination_75px.png" alt="Hospital Veterinario"></div>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur blanditiis laborum nam cupiditate culpa obcaecati a, nihil nobis deserunt aut sint voluptatibus tenetur corporis delectus eos molestiae et dolores pariatur!</p>
		</a>
	</div>
</div>

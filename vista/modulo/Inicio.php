<?php
	$citas = ControladorAgenda::selCitasCtl();
	$fechaA = DataArrays::getFecha();
	$counterCitas = DataArrays::getCounterCitas($citas);
?>
<div class="C__F">
	<div class="slider">
		<ul id="sliderContent">
			<li class="slide overlay" data-content="Servicios">
				<div class="quick">
					<a href="index.php?pagina=Servicios">
						<img src="img/SliderImg1.jpg" alt="Servicios Slider">
					</a>
				</div>
			</li>
			<li class="slide overlay" data-content="Ubicación">
				<div class="quick">
					<img src="img/SliderImg2.jpg" alt="Servicios Slider">
				</div>
			</li>
			<li class="slide overlay" data-content="Eventos">
				<div class="quick">
					<img src="img/SliderImg3.jpg" alt="Servicios Slider">
				</div>
			</li>
			<li class="slide overlay" data-content="Contacto">
				<div class="quick">
					<img src="img/SliderImg4.jpg" alt="Servicios Slider">
				</div>
			</li>
		</ul>
		<!-- <div class="ctrlSlider"> -->
			<button id="prevSlide">&#60</button>
			<button id="nextSlide">&#62</button>
		<!-- </div> -->
	</div>
</div>

<div class="C__Table">
	<div class="Bar__Btns column">
		<span class="Lbl__Bar">Formatos</span>
		<div class="C__Btn list">
			<a href="index.php?pagina=HistoriaMedica&type-doc=generar" id="historiaBtn-d" class="btn">Formato Historia Médica.docx</a>
			<a href="index.php?pagina=HistoriaMedica&type-doc=llenar" id="plantillaBtn-d" class="btn">Generar Historia Médica.docx</a>
		</div>
	</div>
	
	<div class="Bar__Btns column">
		<span class="Lbl__Bar">Agenda</span>
		<div class="C__Btn ">
			<a 
				href="Agenda" 
				class="btn <?=$counterCitas["atrasadas"] > 0 ? 'new' : '' ?>">
				Hay <?=$counterCitas["atrasadas"]?> pacientes con citas atrasadas</a>
			<a 
				href="Agenda" 
				class="btn <?=$counterCitas["actuales"] > 0 ? 'new' : '' ?>">
				Hay <?=$counterCitas["actuales"]?> pacientes nuevos</a>
			<a 
				href="Agenda" 
				class="btn <?=$counterCitas["hoy"] > 0 ? 'new' : '' ?>">
				Hay <?=$counterCitas["hoy"]?> pacientes nuevos para hoy</a>
		</div>
	</div>
	
	<div class="Bar__Btns column">
		<span class="Lbl__Bar">Pacientes</span>
		<div class="C__Btn list">
			<a href="Pacientes" class="btn">Hay n pacientes para hoy</a>
			<!-- <a href="index.php?pagina=HistoriaMedica&type-doc=llenar" id="plantillaBtn-d" class="btn">Generar Historia Médica.docx</a> -->
		</div>
	</div>
	<div class="Bar__Btns column">
	</div>
</div>
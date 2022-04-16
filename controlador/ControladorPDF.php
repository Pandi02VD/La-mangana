<?php
	if (
		isset($_GET["us"])
		) {
		$medicina = ControladorServicios::medicinaInfoCtl($_GET["us"]);
		sizeof($medicina);
?>
	<style>
		*{
			text-transform: uppercase;
		}

		.pdf{
			height: 100%;
			width: 750px;
			position: relative;
			margin: 0;
			border: 1px solid red;
		}

		.pdfHead{
			width: 750px;
			border: 1px solid;
			position: relative;
		}

		.pdfHead img {
			width: 100px;
		}

		#caduceus {
			float: right;
			top: 0;
		}

		.datosMedico {
			display: inline-block;
			position: absolute;
			left: 0;
			align-self: center;
			width: auto;
			height: auto;
			font-size: 18px;
			border: 1px solid;
		}

		.datosMedico div {
			text-align: center;
		}

		.B{
			font-weight: bold;
		}

		.datosPXTop{
			margin: 15px 10px 0 10px;
			padding: 0;
			/* border: 1px blue; */
			width: 435px;
		}

		.fecha{
			display: inline-flex;
			text-align: right;
		}
		
		.grupo{
			display: inline-flex;
			/* border: 1px green; */
			text-align: right;
			width: 300px;
			height: 35px;
		}

		.inputs, .labels {
			font-size: 15px;
		}

		.inputs{
			border-bottom: 1px solid;
			/* background: pink; */
		}

		.labels{
			/* background: gray; */
		}

		.datosPX{
			display: inline-flex;
			margin: 15px 10px 0 10px;
			padding: 0;
			/* border: 1px blue; */
		}

		.perrito{
			width: 100px;
		}

		.datosPXBottom .grupo {
			width: 100%;
			text-align: left;
		}

		.datosPXImg {
			display: inline-flex;
			width: 100px;
			border: 1px solid;
		}

		.pdfFooter{
			display: inline-flex;
			flex-direction: column;
			align-self: center;
			background: url(img/receta/pdfFooter.png) center no-repeat fill;
			padding: 0;
			height: 260px;
		}
	</style>

	<div class="pdf">
		<div class="pdfHead">
			<img src="img/receta/LogoCuadro.png" alt="Logo">
			<div class="datosMedico">
				<div>Médico Veterinario Zootecnista</div>
				<div>Vladimir Arellano Leal</div>
				<div>Ced. Prof. 09633906</div>
			</div>
			<img id="caduceus" src="img/Caduceus.png" alt="Caduceus">
		</div>
		<div class="datosPXTop">
			<div class="fecha">
				<div class="grupo">
					<span class="labels">Fecha:</span>
					<span class="inputs" name="fechaReceta" id="fechaReceta">_______________________</span>
				</div>
				<div class="grupo">
					<span class="labels">RX:</span>
					<span class="inputs" name="RXReceta" id="RXReceta">_______________________</span>
				</div>
			</div>
		</div>
		<div class="datosPX">
			<div class="datosPXBottom">
				<div class="grupo">
					<span class="labels">Paciente:</span>
					<span class="inputs" name="PXReceta" id="PXReceta">______________________________________________________________________________</span>
				</div>
				<div class="grupo">
					<span class="labels">Especie:</span>
					<span class="inputs" name="expecieReceta" id="expecieReceta"></span>
				</div>
				<div class="grupo">
					<span class="labels">Propietario:</span>
					<span class="inputs" name="propReceta" id="propReceta">___________________________________________________________________________</span>
				</div>
				<div class="grupo">
					<span class="labels">Sexo:</span>
					<span class="inputs" name="sexoReceta" id="sexoReceta"></span>
				</div>
			</div>
			<img src="img/receta/Huellas.png" alt="Huellas">
			<img class="perrito" src="img/receta/Imagenperrito.png" alt="Imagen perrito">
		</div>

		<ul class="recetaLista">
			<?php foreach (json_decode($medicina[0]["medicacion"]) AS $k => $v) :?>
				<li>
					<?=$v?>
				</li>
			<?php endforeach;?>
		</ul>
		
		<div class="pdfFooter"></div>
	</div>
<?php
	}
?>
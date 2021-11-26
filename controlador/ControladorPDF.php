<?php
	// if (isset($_POST["printpdf"])) {
?>
	<style>
		.pdf{
			height: 99%;
		}

		.pdf__head{
			margin-bottom: 20px;
		}

		.pdf__decorate{
			display: inline-block; position: relative; width: 84%; height: 40px; background-color: rgb(100, 100, 240); margin-left: 17px; text-transform: uppercase;
		}

		.pdf__decorate__2{
			position: absolute; width: 80%; height: 40px; background-color: rgb(240, 90, 100);
		}

		.pdf__info{
			display: inline-block; width: 100%; text-align: center; font-size: 20px; margin-bottom: 20px;
		}

		.uppcase{
			text-transform: uppercase;
		}

		.pdf__content-table{
			width: 100%; font-size: 16px;
		}

		.pdf__content-table-cell{
			display: inline-block; text-transform: uppercase;
		}

		.pdf__foot{
			position: absolute; bottom: 0; font-size: 20px;
		}

		.pdf__foot-content{
			display: inline-block; text-align: center;
		}

		.pdf-W10{
			width: 10%;
		}
		
		.pdf-W20{
			width: 20%;
		}
		
		.pdf-W30{
			width: 30%;
		}
		
		.pdf-W50{
			width: 50%;
		}

		.pdf-TA-r{
			text-align: right;
		}

		.pdf-MB-20{
			margin-bottom: 20px;
		}

		.pdf__lineDa{
			display: inline-block; width: 100%; border-top: 1px dashed black; margin: 10px 0;
		}

		.border{
			border: 1px solid black;
		}

		.Bold{
			font-weight: bold;
		}
	</style>

	<div class="pdf">
		<div class="pdf__head">
			<!-- <img src="ima/LogoEF2pdf.png" alt="Logo EF" width="100"> -->
			<div class="pdf__decorate">
				<div class="pdf__decorate__2"></div>
			</div>
		</div>
		<div class="pdf__info">
			<span class="uppcase">Electrónica Fonseca</span><br>
			<span class="uppcase">Guillermo Prieto #23, colonia</span><br>
			<span class="uppcase">Independencia, Martínez de la</span><br>
			<span class="uppcase">Torre, Veracruz. CP: 93610, México.</span>
		</div>
		<div class="pdf__info" style="margin-bottom: 40px">
				<span class="uppcase">Folio: </span><br>
				<span class="uppcase">Cliente: </span><br>
				<span class="uppcase">Fecha: </span><br>
		</div>
			<table class="pdf__content-table">
				<tr>
					<th class="pdf__content-table-cell pdf-W10"><span>#</span></th>
					<th class="pdf__content-table-cell pdf-W10"><span>Cant.</span></th>
					<th class="pdf__content-table-cell pdf-W30"><span>Producto</span></th>
					<th class="pdf__content-table-cell pdf-W20 pdf-TA-r"><span>Precio unitario</span></th>
					<th class="pdf__content-table-cell pdf-W30 pdf-TA-r"><span>Total</span></th>
				</tr>
				<tr>
					<td class="pdf__content-table-cell pdf-W10">Contenido</td>
					<td class="pdf__content-table-cell pdf-W10">Contenido</td>
					<td class="pdf__content-table-cell pdf-W30">Contenido</td>
					<td class="pdf__content-table-cell pdf-W20 pdf-TA-r">Contenido</td>
					<td class="pdf__content-table-cell pdf-W30 pdf-TA-r">Contenido</td>
				</tr>
			</table>

			<div class="pdf__lineDa"></div>
			<table class="pdf__content-table">
				<tr>
					<th class="pdf__content-table-cell pdf-W10"></th>
					<th class="pdf__content-table-cell pdf-W30">Artículos</th>
					<th class="pdf__content-table-cell pdf-W10"></th>
					<th class="pdf__content-table-cell pdf-W20"></th>
					<th class="pdf__content-table-cell pdf-W30 pdf-TA-r">Importe</th>
				</tr>
				<tr>
					<td class="pdf__content-table-cell pdf-W10 Bold">Total:</td>
					<td class="pdf__content-table-cell pdf-W30">Contenido</td>
					<td class="pdf__content-table-cell pdf-W10"></td>
					<td class="pdf__content-table-cell pdf-W20"></td>
					<td class="pdf__content-table-cell pdf-W30 pdf-TA-r">Contenido</td>
				</tr>
			</table>
		
		<div class="pdf__foot">
			<div class="pdf__foot-content pdf-MB-20">Contáctenos: 232 153 16 52 y 232 322 93 54</div>
			<div class="pdf__foot-content">¡Siempre en los mejores eventos!</div>
			<div class="pdf__foot-content">¡Gracias por comprar en Electrónica Fonseca!</div>
		</div>
	</div>
<?php
	// }
?>
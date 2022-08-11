<?php
	if (isset($_GET["type-doc"])) {
		if ($_GET["type-doc"] == 'llenar') {
			ControladorWord::llenarHistoriaMedicaCtl();
		} elseif ($_GET["type-doc"] == 'generar') {
			ControladorWord::generarHistoriaMedicaCtl();
		} else {
			//Nothing to do.
		}
	}
?>
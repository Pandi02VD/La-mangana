<?php
	// use Spipu\Html2Pdf\Html2Pdf;
	ob_start();
	require_once 'vendor/autoload.php';
	require_once 'controlador/ControladorPDF.php';
	$content = ob_get_clean();

	$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('p', 'letter', 'es', 'true', 'utf-8');
	$html2pdf->pdf->SetAuthor('La Mangana');
	$html2pdf->pdf->SetTitle('Receta médica');
	$html2pdf->pdf->SetSubject('Receta médica');
	$html2pdf->pdf->SetKeywords('La mangana, receta médica, prescripción');
	$html2pdf -> writeHTML($content);
	$html2pdf -> Output('Receta médica.pdf');
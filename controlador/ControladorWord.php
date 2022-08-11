<?php
	class ControladorWord {
		#Generar archivo DOCX de Historia médica y dental.
		public function generarHistoriaMedicaCtl() {
			require_once dirname(__FILE__).'/../lib/PHPWord-master/src/PhpWord/Autoloader.php';
			\PhpOffice\PhpWord\Autoloader::register();
			
			$templateWord = new \PhpOffice\PhpWord\TemplateProcessor('documentos/HISTORIA MEDICA ECO.docx');
			
			#Guardamos el documento
			$templateWord->saveAs('documentos/HISTORIA MEDICA ECO.docx');
			
			header("Content-Disposition: attachment; filename=HISTORIA MEDICA ECO.docx; charset=iso-8859-1");
			echo file_get_contents('documentos/HISTORIA MEDICA ECO.docx');
		}

		#Llenar archivo DOCX de Historia médica y dental.
		public function llenarHistoriaMedicaCtl() {
			require_once dirname(__FILE__).'/../lib/PHPWord-master/src/PhpWord/Autoloader.php';
			\PhpOffice\PhpWord\Autoloader::register();
			
			$templateWord = new \PhpOffice\PhpWord\TemplateProcessor('documentos/HISTORIA MEDICA ECO Plantilla.docx');
			// $propiedades = $templateWord->getDocInfo();
			// $propiedades->setCreator("Econodental Plus");
			// $propiedades->setCompany("Econodental Plus");
			// $propiedades->setTitle("HISTORIA MEDICA ECO");
			// $propiedades->setDescription("This document was create with PHP");
			// $propiedades->setCategory("Formatos");
			// $propiedades->setLastModifiedBy("Econodental Plus");
			// $propiedades->setCreated(mktime());
			// $propiedades->setModified(mktime());
			// $propiedades->setSubject("Historia médica");
			// $propiedades->setKeywords("Formatos, Historia medica, Documento");
			// # Para que no diga que se abre en modo de compatibilidad
			// $documento->getCompatibility()->setOoxmlVersion(15);
			// # Idioma español de México
			// $documento->getSettings()->setThemeFontLang(new Language("ES-MX"));
			
			$fecha = '23/12/2021';
			$paciente = "Sandra S.L.";
			$edad = "18";
			$nacimiento = "01/01/2000";
			$direccion = "Adonis Turnpike, 64707, Jasminmouth";
			$tel_domicilio = "873-250-7930";
			$tel_trabajo = "466-576-3702";
			$ext = "123";
			$ocupacion = "Central Applications Manager";
			$edo_civil = "Soltera";
			$email = "Jodie.Cole20@hotmail.com";
			$tel_whatsapp = "24536784";
			$facebook = "Rafaela_Shields50";
			$recomendado = "Pete Reilly";
			
			// --- Asignamos valores a la plantilla
				$templateWord->setValue('fecha', $fecha);
				$templateWord->setValue('paciente', $paciente);
				$templateWord->setValue('edad', $edad);
				$templateWord->setValue('nacimiento', $nacimiento);
				$templateWord->setValue('direccion', $direccion);
				$templateWord->setValue('tel_domicilio', $tel_domicilio);
				$templateWord->setValue('tel_trabajo', $tel_trabajo);
				$templateWord->setValue('ext', $ext);
				$templateWord->setValue('ocupacion', $ocupacion);
				$templateWord->setValue('edo_civil', $edo_civil);
				$templateWord->setValue('email', $email);
				$templateWord->setValue('tel_whatsapp', $tel_whatsapp);
				$templateWord->setValue('facebook', $facebook);
				$templateWord->setValue('recomendado', $recomendado);
			// --- Guardamos el documento
			$templateWord->saveAs('documentos/HISTORIA MEDICA ECO LLENA.docx');
			
			header("Content-Disposition: attachment; filename=HISTORIA MEDICA ECO LLENA.docx; charset=iso-8859-1");
			echo file_get_contents('documentos/HISTORIA MEDICA ECO LLENA.docx');

			// require_once dirname(__FILE__).'/../lib/PHPWord-master/src/PhpWord/Autoloader.php';
			// \PhpOffice\PhpWord\Autoloader::register();

			// // use PhpOffice\PhpWord\PhpWord;
			// // use PhpOffice\PhpWord\Style\Font;

			// //Instancia phpWord.
			// $documento = new \PhpOffice\PhpWord\PhpWord();
			// // $documento = new PhpWord();

			// // Nueva seccion
			// $seccion = $documento->addSection();

			// // Texto sin formato
			// $seccion->addText(
			// htmlspecialchars(
			// 		'Primer texto - Texto sin formato'
			// )
			// );

			// // Texto con formato
			// $seccion->addText(
			// 		htmlspecialchars(
			// 				'Segundo texto con formato'
			// 		),
			// 		array('name' => 'Arial', 'size' => '12', 'bold' => 'true')
			// );

			// // Texto con fuente personalizada
			// $fuente_propia = 'mifuente';
			// $documento->addFontStyle($fuente_propia, 
			// 		array('name' => 'Arial', 'size' => '14', 'bold' => 'true', 'color' => '5882FA')
			// );

			// $seccion->addText(
			// 		htmlspecialchars(
			// 				'Tercer texto con formato'
			// 		),
			// 		$fuente_propia
			// );

			// // Texto con objetos
			// $fuente = new \PhpOffice\PhpWord\Style\Font;
			// $fuente->setBold(true);
			// $fuente->setName('Tahoma');
			// $fuente->setSize(16);
			// $fuente->setColor('9F81F7');
			// $texto = $seccion->addText(htmlspecialchars(
			// 				'Cuarto texto con formato'
			// 		));
			// $texto->setFontStyle($fuente);

			// // Tabla personalizada
			// $estilo_tabla = array(
			// 		'borderColor' => 'F2F2F2',
			// 		'borderSize' => '5',
			// 		'cellMargin' => '20',
			// 		'bgColor' => '088A68',
			// );

			// $primera_fila = array('bgColor' => 'F2F2F2');
			// $documento->addTableStyle('mitabla',$estilo_tabla, $primera_fila);
			// $tabla = $seccion->addTable('mitabla');
			// for ($row = 1; $row <= 8; $row++) {
			// 	$tabla->addRow();
			// 	for ($cell = 1; $cell <= 3; $cell++) {
			// 		if($row ==1)
			// 			$tabla->addCell(200)->addText(htmlspecialchars('primera'));
			// 		else
			// 			$tabla->addCell(200)->addText(htmlspecialchars('celda'));
			// 	}
			// }

			// // Espacio
			// $seccion->addTextBreak(1);

			// // Imagen
			// $seccion->addImage(
			// 		'img/Logo.jpg',
			// 		array(
			// 				'width' => 600,
			// 				'height' => 400,
			// 				'wrappingStyle' => 'behind'
			// 		)
			// );


			// //Guardando documento
			// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, 'Word2007');
			// $objWriter->save("documentos/HISTORIA MEDICA ECO.docx");

			// header("Content-Disposition: attachment; filename=HISTORIA MEDICA ECO.docx; charset=iso-8859-1");
			// echo file_get_contents('documentos/HISTORIA MEDICA ECO.docx');
		}
	}
<?php
	class Paginacion {
		public function pnt($modulo, $noItems, $pag, $size) {
			$paginas = 0;
			$inicio = 0;
			if($noItems > $size){
				$paginas = ceil($noItems / $size);
				$inicio = ($pag - 1) * $size;
				if ($pag < 1 || $pag > $paginas) {
					echo '
						<script>
							let uriJ = window.location;

							window.location = uriJ + "&pag=1";
						</script>
						';
				}
			}

			$parametros = array(
				'onPrev' => '', 'hrefPrev' => '', 
				'onNext' => '', 'hrefNext' => '', 
				'inicio' => '', 'pags' => ''
			);
			if($noItems > $size){ 
				$pag <= 1 ? $parametros['onPrev'] = 'disabled' : '';
				$parametros['hrefPrev'] = 'index.php?pagina='.$modulo.'&pag='.($pag - 1);
				$pag >= $noItems ? $parametros['onNext'] = 'disabled' : '';
				$parametros['hrefNext'] = 'index.php?pagina='.$modulo.'&pag='.($pag + 1);
				$parametros['pags'] = $paginas;
				$parametros['inicio'] = $inicio;
			} else {
				$parametros = null;
			}
			return $parametros;
		}
	}
?>
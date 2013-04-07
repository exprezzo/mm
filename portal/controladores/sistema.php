<?php
require_once '../'.$_PETICION->modulo.'/modelos/catalogo_modelo.php';
class Sistema extends Controlador{
	function index($vistaFile=''){						
		$vista= $this->getVista();					
		
		// $catMod = new CatalogoModelo();		
		
		// $params=array(
			// 'start'=>0,
			// 'limit'=>1000
		// );
		// $res=$catMod->buscar( $params );		
		// $vista->catalogos=$res['datos'];
		
		$vista->catalogos=array();
		
		return $vista->mostrar( '/index' );
	}
	function cssmenu(){
		header("Content-type: text/css");
		$catMod = new CatalogoModelo();
		$params=array(
			'start'=>0,
			'limit'=>1000
		);
		$res=$catMod->buscar( $params );
		foreach($res['datos'] as $cat){
			echo 'ul.ui-tabs-nav li a.tab_'.$cat['controlador'].'{ background-image:url("'.$cat['icono'].'"); } ';
		}
		exit;
		
	}
	function menu($vistaFile=''){
		$vista= $this->getVista();
		$catMod = new CatalogoModelo();
		$params=array(
			'start'=>0,
			'limit'=>1000
		);
		$res=$catMod->buscar( $params );
		$vista->catalogos=$res['datos'];
		
		return $vista->mostrar( );
	}
}
?>
<?php
require_once '../'.$_PETICION->modulo.'/modelos/catalogo_modelo.php';
require_once '../'.$_PETICION->modulo.'/modelos/Producto_modelo.php';
class Portal extends Controlador{
	function index($vistaFile=''){						
		$vista= $this->getVista();							
		
		$prodMod=new ProductoModelo();
		$res=$prodMod->buscar(array());
		$vista->productos=$res['datos'];
		
		return $vista->mostrar(  );
	}	
}
?>